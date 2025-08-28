<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Appointment;
use App\Models\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
            $query = $relation->with([
                'service',
                'bill',
                'review',
                'doctor.user',
                'doctor.medicalCategory',
                'hospital',
                'examResult',
                'examResult.files'
            ]);

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
     * Submit review for appointment
     */
    public function submitReview(Request $request, $appointmentId)
    {
        try {
            $user = Auth::user();

            // Validate the request
            $request->validate([
                'rate' => 'required|integer|min:1|max:5',
                'review' => 'nullable|string|max:1000',
                'recommend' => 'required|boolean'
            ]);

            // Find the appointment
            $appointment = Appointment::where('id', $appointmentId)
                ->where('patient_profile_id', $user->patientProfile->id)
                ->where('status', 'completed')
                ->first();

            if (!$appointment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Appointment not found or not eligible for review'
                ], 404);
            }

            if ($appointment->review) {
                return response()->json([
                    'success' => false,
                    'message' => 'Review already exists for this appointment'
                ], 400);
            }

            $review = Review::create([
                'appointment_id' => $appointment->id,
                'patient_profile_id' => $user->patientProfile->id,
                'doctor_profile_id' => $appointment->doctor_profile_id,
                'rate' => $request->rate,
                'review' => $request->review,
                'recommend' => $request->recommend ? 1 : 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully',
                'review' => $review
            ]);
        } catch (\Exception $e) {
            Log::error('Error submitting review: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the review'
            ], 500);
        }
    }

    /**
     * Show appointment history page
     */
    public function submitSupport(Request $request, Appointment $appointment)
    {
        try {
            $request->validate([
                'support_type' => 'required|string|in:medical_question,treatment_support,prescription_help,other',
                'message' => 'required|string|min:10|max:2000'
            ]);

            // Verify appointment belongs to current user and is completed
            if ($appointment->patient_profile_id !== Auth::user()->patientProfile->id || $appointment->status !== 'completed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cuộc hẹn không tồn tại hoặc chưa hoàn thành.'
                ], 404);
            }

            // Load doctor relationship if not already loaded
            $appointment->loadMissing('doctor.user');

            $supportTypeMap = [
                'medical_question' => 'Câu hỏi y tế',
                'treatment_support' => 'Hỗ trợ điều trị',
                'prescription_help' => 'Hỗ trợ đơn thuốc',
                'other' => 'Khác'
            ];

            $supportTypeText = $supportTypeMap[$request->support_type] ?? 'Khác';

            // Create support request
            $support = Support::create([
                'patient_id' => Auth::id(),
                'doctor_id' => $appointment->doctor->user->id,
                'appointment_id' => $appointment->id,
                'hospital_id' => $appointment->hospital_id,
                'message' => "{$supportTypeText}: {$request->message}",
                'status' => 'open'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Yêu cầu hỗ trợ đã được gửi thành công.',
                'support_id' => $support->id
            ]);
        } catch (\Exception $e) {
            Log::error('Support submission error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi gửi yêu cầu hỗ trợ. Vui lòng thử lại.'
            ], 500);
        }
    }

    /**
     * Cancel appointment
     */
    public function cancelAppointment(Request $request, Appointment $appointment)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'cancel_reason' => 'required|string|max:500'
            ]);

            if (
                $appointment->patient_profile_id !== $user->patientProfile->id ||
                !in_array($appointment->status, ['pending', 'confirmed', 'upcoming'])
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Appointment not found or cannot be cancelled'
                ], 404);
            }

            // Check if appointment can be cancelled (6 hours before)
            $appointmentDateTime = $this->parseAppointmentDateTime($appointment->date, $appointment->time);
            if (!$appointmentDateTime) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid appointment time format'
                ], 400);
            }

            $hoursUntilAppointment = Carbon::now()->diffInHours($appointmentDateTime, false);
            if ($hoursUntilAppointment <= 6) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot cancel appointment within 6 hours of scheduled time'
                ], 400);
            }

            // Update appointment status to cancelled
            $appointment->update([
                'status' => 'cancelled',
                'reason' => $request->cancel_reason
            ]);

            // Process refund if there's a bill
            // if ($appointment->bill && $appointment->bill->status === 'paid') {
            //     $total = $appointment->bill->total;
            //     $user->deposit($total, [
            //         'description' => 'Refund for cancelled appointment',
            //         'appointmentId' => $appointment->id
            //     ], true);

            //     $appointment->bill->update(['status' => 'refunded']);
            // }

            $appointment->doctor?->user?->notify(
                \Filament\Notifications\Notification::make()
                    ->title('Lịch hẹn bị hủy')
                    ->body("Bệnh nhân {$user->name} đã hủy lịch hẹn vào {$appointment->date} {$appointment->time}. Lý do: {$request->cancel_reason}")
                    ->warning()
                    ->toDatabase()
            );

            return response()->json([
                'success' => true,
                'message' => 'Appointment cancelled successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error cancelling appointment: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while cancelling the appointment'
            ], 500);
        }
    }

    /**
     * Parse appointment date and time to Carbon instance
     */
    private function parseAppointmentDateTime($date, $time)
    {
        try {
            $timeParts = preg_split('/\s*-\s*/', $time);
            $startTime = $timeParts[0] ?? $time;
            return Carbon::parse("{$date} {$startTime}");
        } catch (\Exception $e) {
            Log::error("Error parsing appointment datetime. Date: {$date}, Time: {$time}, Error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Show support requests page
     */
    public function supportRequests(Request $request)
    {
        $user = Auth::user();

        // Verify user is a patient
        if ($user->user_type !== 'patient') {
            abort(403, 'Access denied. This page is only for patients.');
        }

        $status = $request->get('status');

        $supportQuery = Support::with([
            'doctor',
            'appointment.service',
            'appointment.doctor.medicalCategory',
            'hospital'
        ])
            ->where('patient_id', $user->id)
            ->orderBy('created_at', 'desc');

        if ($status && in_array($status, ['open', 'closed'])) {
            $supportQuery->where('status', $status);
        }

        $supportRequests = $supportQuery->paginate(10);

        // Calculate statistics
        $statistics = [
            'total' => Support::where('patient_id', $user->id)->count(),
            'open' => Support::where('patient_id', $user->id)->where('status', 'open')->count(),
            'closed' => Support::where('patient_id', $user->id)->where('status', 'closed')->count(),
        ];

        return view('user.support-requests', compact('supportRequests', 'statistics'));
    }

    private function clearProfileCompletionCache($userId)
    {
        $cacheKey = "profile_completion_{$userId}";
        Cache::forget($cacheKey);
    }
}
