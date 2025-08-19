<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Services\ProfileService;
use App\Http\Requests\PatientEditProfileRequest;
use Carbon\Carbon;

class PatientProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show the patient profile page
     */
    public function show()
    {
        $user = Auth::user();

        // Verify user is a patient
        if ($user->user_type !== 'patient') {
            abort(403, 'Access denied. This page is only for patients.');
        }

        // Fetch profile data with optimized eager loading
        $profileData = $this->profileService->fetchPatientProfileData($user);

        if (isset($profileData['error'])) {
            return redirect()->back()->with('error', $profileData['error']);
        }

        $completionPercentage = $this->calculateProfileCompletion($user, $user->patientProfile);
        $bim = $this->getBMIInfo(
            $user->patientProfile?->height,
            $user->patientProfile?->weight
        );

        return view('user.profile', compact(
            'user',
            'profileData',
            'bim',
            'completionPercentage',
        ));
    }

    /**
     * Show the edit profile form
     */
    public function edit()
    {
        // Eager load all necessary relationships to avoid N+1 queries
        $user = Auth::user()->load([
            'patientProfile.insurance',
            'languages.language'
        ]);

        if ($user->user_type !== 'patient') {
            abort(403, 'Access denied. This page is only for patients.');
        }

        return view('user.profile-edit', compact('user'));
    }

    public function update(PatientEditProfileRequest $request)
    {
        $user = Auth::user();

        if ($user->user_type !== 'patient') {
            abort(403, 'Access denied. This page is only for patients.');
        }

        $profileData = $this->profileService->updatePatientProfile($user, $request->validated());

        if (isset($profileData['error'])) {
            return redirect()->back()->with('error', $profileData['error'])->withInput();
        }

        // Clear profile cache
        $this->profileService->clearProfileCache($user->id);

        // Clear profile completion cache
        $this->clearProfileCompletionCache($user->id);

        return redirect()->route('profile.index')->with('success', 'Hồ sơ cập nhật thành công!');
    }

    /**
     * Calculate profile completion percentage
     */
    private function calculateProfileCompletion($user, $patientProfile)
    {
        // Cache the profile completion percentage for 30 minutes
        $cacheKey = "profile_completion_{$user->id}";

        return Cache::remember($cacheKey, 1800, function () use ($user, $patientProfile) {
            $fields = [
                'name' => !empty($user->name),
                'email' => !empty($user->email),
                'phone' => !empty($user->phone),
                'gender' => !empty($user->gender),
                'address' => !empty($user->address),
                'avatar' => !empty($user->avatar) && $user->avatar !== '/upload/avatar/default.png',
                'birth_date' => !empty($patientProfile?->birth_date),
                'height' => !empty($patientProfile?->height),
                'weight' => !empty($patientProfile?->weight),
                'blood_group' => !empty($patientProfile?->blood_group),
                'medical_history' => !empty($patientProfile?->medical_history),
                'insurance' => !empty($patientProfile?->insurance?->insurance_type),
            ];

            $completedFields = array_filter($fields);
            return round((count($completedFields) / count($fields)) * 100);
        });
    }

    /**
     * Get recent completed appointments
     */
    private function getRecentAppointments($user)
    {
        if (!$user->patientProfile) {
            return collect();
        }

        return $user->patientProfile->appointments
            ->where('status', 'completed')
            ->sortByDesc('date')
            ->take(3)
            ->values();
    }

    /**
     * Get upcoming appointments
     */
    private function getUpcomingAppointments($user)
    {
        if (!$user->patientProfile) {
            return collect();
        }

        return $user->patientProfile->appointments
            ->whereIn('status', ['pending', 'confirmed', 'upcoming'])
            ->where('date', '>=', Carbon::now()->toDateString())
            ->sortBy('date')
            ->take(3)
            ->values();
    }

    /**
     * Get BMI status and color
     */
    public static function getBMIInfo($height, $weight)
    {
        if (!$height || !$weight) {
            return ['status' => 'Unknown', 'color' => 'gray', 'value' => 0];
        }

        $heightInMeters = $height / 100;
        $bmi = $weight / ($heightInMeters * $heightInMeters);

        if ($bmi < 18.5) {
            return ['status' => 'Thiếu cân', 'color' => 'blue', 'value' => round($bmi, 1)];
        } elseif ($bmi < 25) {
            return ['status' => 'Bình thường', 'color' => 'green', 'value' => round($bmi, 1)];
        } elseif ($bmi < 30) {
            return ['status' => 'Thừa cân', 'color' => 'yellow', 'value' => round($bmi, 1)];
        } else {
            return ['status' => 'Béo phì', 'color' => 'red', 'value' => round($bmi, 1)];
        }
    }

    /**
     * Show appointment history page
     */
    public function appointmentHistory(Request $request)
    {
        $user = Auth::user();

        if ($user->user_type !== 'patient') {
            abort(403, 'Access denied. This page is only for patients.');
        }

        $status = $request->get('status');
        $allowedStatuses = ['completed', 'upcoming', 'confirmed', 'cancelled', 'pending'];
        if (!in_array($status, $allowedStatuses, true)) {
            $status = null;
        }

        // Load only what we need (avoid loading all appointments)
        $user->loadMissing('patientProfile');

        $appointments = collect();
        $statistics = [
            'total' => 0,
            'completed' => 0,
            'upcoming' => 0,
            'cancelled' => 0,
            'pending' => 0,
        ];

        if ($user->patientProfile) {
            $relation = $user->patientProfile->appointments();

            // Paginated list with necessary relationships for current page only
            $query = $relation->with(['service', 'bill', 'review', 'doctor.user', 'doctor.medicalCategory', 'hospital']);

            if ($status) {
                if (in_array($status, ['upcoming', 'confirmed'], true)) {
                    $query->whereIn('status', ['upcoming', 'confirmed']);
                } else {
                    $query->where('status', $status);
                }
            }

            $appointments = $query
                ->orderByDesc('date')
                ->orderByDesc('time')
                ->paginate(10)
                ->withQueryString();

            // Efficient statistics (single grouped query, no model hydration)
            // Use a fresh relation to avoid carrying order/limit from the paginated query (ONLY_FULL_GROUP_BY safe)
            $counts = $user->patientProfile->appointments()
                ->selectRaw('status, COUNT(*) as aggregate')
                ->groupBy('status')
                ->pluck('aggregate', 'status')
                ->all();

            $statistics['total'] = array_sum($counts);
            $statistics['completed'] = $counts['completed'] ?? 0;
            $statistics['cancelled'] = $counts['cancelled'] ?? 0;
            $statistics['pending'] = $counts['pending'] ?? 0;
            $statistics['upcoming'] = ($counts['upcoming'] ?? 0) + ($counts['confirmed'] ?? 0);
        }

        return view('user.appointment-history', compact('user', 'appointments', 'statistics'));
    }


    /**
     * Clear profile completion cache
     */
    private function clearProfileCompletionCache($userId)
    {
        $cacheKey = "profile_completion_{$userId}";
        Cache::forget($cacheKey);
    }
}
