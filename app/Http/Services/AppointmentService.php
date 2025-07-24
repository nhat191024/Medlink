<?php

namespace App\Http\Services;

use App\Models\Bill;
use App\Models\Service;
use App\Models\Appointment;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use App\Jobs\ProcessAppointmentPayment;
use App\Http\Resources\DoctorAppointmentResource;

use App\Http\Services\PaymentService;
use Carbon\Carbon;

use App\Helper\CacheKey;

class AppointmentService
{
    private $paymentService;
    private $cacheKey;

    public function __construct()
    {
        $this->paymentService = app(PaymentService::class);
        $this->cacheKey = new CacheKey();
    }

    /**
     * Get appointments by type for a doctor profile
     */
    public function getAppointmentsByType($profileId, $userType)
    {
        $baseQuery = null;

        if ($userType === 'healthcare') {
            $baseQuery = Appointment::with(['patient.user', 'service', 'bill'])
                ->where('doctor_profile_id', $profileId);
        } elseif ($userType === 'patient') {
            $baseQuery = Appointment::with(['doctor.user', 'service', 'bill', 'doctor.medicalCategory'])
                ->where('patient_profile_id', $profileId);
        }

        $result = [];

        if ($userType === 'healthcare') {
            $result['new'] = (clone $baseQuery)
                ->where('status', 'pending')
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get();

            $result['upcoming'] = (clone $baseQuery)
                ->where('status', 'upcoming')
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get();
        } elseif ($userType === 'patient') {
            $result['upcoming'] = (clone $baseQuery)
                ->whereIn('status', ['pending', 'upcoming'])
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get();
        }

        $result['history'] = (clone $baseQuery)
            ->whereIn('status', ['cancelled', 'rejected', 'completed'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->limit(50)
            ->get();

        return $result;
    }

    /**
     * Calculate appointment statistics
     */
    public function calculateAppointmentStatistics($appointments)
    {
        $totalNew = $appointments['new']->count();
        $totalUpcoming = $appointments['upcoming']->count();
        $totalHistory = $appointments['history']->count();

        $todayAppointments = $appointments['upcoming']
            ->where('date', now()->toDateString())
            ->count();

        $thisWeekAppointments = $appointments['upcoming']
            ->whereBetween('date', [
                now()->startOfWeek()->toDateString(),
                now()->endOfWeek()->toDateString()
            ])
            ->count();

        $completedThisMonth = $appointments['history']
            ->where('status', 'completed')
            ->where('date', '>=', now()->startOfMonth()->toDateString())
            ->count();

        return [
            'total_new' => $totalNew,
            'total_upcoming' => $totalUpcoming,
            'total_history' => $totalHistory,
            'today_appointments' => $todayAppointments,
            'this_week_appointments' => $thisWeekAppointments,
            'completed_this_month' => $completedThisMonth,
        ];
    }

    /**
     * Get empty statistics structure
     */
    public function getEmptyStatistics()
    {
        return [
            'total_new' => 0,
            'total_upcoming' => 0,
            'total_history' => 0,
            'today_appointments' => 0,
            'this_week_appointments' => 0,
            'completed_this_month' => 0,
        ];
    }

    /**
     * Calculate patient appointment statistics
     */
    public function calculatePatientStatistics($appointments)
    {
        // Count appointments based on their status
        $upcoming = $appointments['upcoming']->count();

        $history = $appointments['history']->count();

        return [
            'total_upcoming' => $upcoming,
            'total_history' => $history,
        ];
    }

    /**
     * Calculate doctor appointment statistics
     */
    public function calculateDoctorStatistics($user)
    {
        $doctorProfile = $user->doctorProfile;

        if (!$doctorProfile) {
            return $this->getEmptyStatistics();
        }

        $appointments = Appointment::where('doctor_profile_id', $doctorProfile->id)->get();

        $today = now()->toDateString();
        $thisWeek = [now()->startOfWeek(), now()->endOfWeek()];
        $thisMonth = [now()->startOfMonth(), now()->endOfMonth()];

        return [
            'total_appointments' => $appointments->count(),
            'pending_appointments' => $appointments->where('status', 'pending')->count(),
            'upcoming_appointments' => $appointments->where('status', 'upcoming')->count(),
            'completed_appointments' => $appointments->where('status', 'completed')->count(),
            'cancelled_appointments' => $appointments->where('status', 'cancelled')->count(),
            'today_appointments' => $appointments->where('date', $today)->count(),
            'this_week_appointments' => $appointments->whereBetween('date', [
                $thisWeek[0]->toDateString(),
                $thisWeek[1]->toDateString()
            ])->count(),
            'this_month_appointments' => $appointments->whereBetween('date', [
                $thisMonth[0]->toDateString(),
                $thisMonth[1]->toDateString()
            ])->count(),
            'average_rating' => $this->calculateAverageRating($doctorProfile),
            'total_revenue' => $this->calculateTotalRevenue($appointments),
        ];
    }

    /**
     * Calculate patient detailed statistics
     */
    public function calculatePatientDetailedStatistics($user)
    {
        $patientProfile = $user->patientProfile;

        if (!$patientProfile) {
            return [];
        }

        $appointments = Appointment::where('patient_profile_id', $patientProfile->id)->get();

        return [
            'total_appointments' => $appointments->count(),
            'pending_appointments' => $appointments->where('status', 'pending')->count(),
            'upcoming_appointments' => $appointments->where('status', 'upcoming')->count(),
            'completed_appointments' => $appointments->where('status', 'completed')->count(),
            'cancelled_appointments' => $appointments->where('status', 'cancelled')->count(),
            'favorite_doctors_count' => $user->favoriteDoctors->count(),
            'total_spent' => $this->calculateTotalSpent($appointments),
        ];
    }

    /**
     * Calculate average rating for doctor
     */
    public function calculateAverageRating($doctorProfile)
    {
        $reviews = $doctorProfile->reviews;
        return $reviews->count() > 0 ? round($reviews->avg('rate'), 1) : 0;
    }

    /**
     * Calculate total revenue from appointments
     */
    public function calculateTotalRevenue($appointments)
    {
        return $appointments->where('status', 'completed')
            ->sum(function ($appointment) {
                return $appointment->service ? $appointment->service->price : 0;
            });
    }

    /**
     * Calculate total spent by patient
     */
    public function calculateTotalSpent($appointments)
    {
        return $appointments->where('status', 'completed')
            ->sum(function ($appointment) {
                return $appointment->bill ? $appointment->bill->total_amount : 0;
            });
    }

    /**
     * Check if user can view appointment
     */
    public function canViewAppointment($user, $appointment)
    {
        if ($user->user_type === 'healthcare' && $user->identity === 'doctor') {
            return $appointment->doctor_profile_id === $user->doctorProfile->id;
        } elseif ($user->user_type === 'patient') {
            return $appointment->patient_profile_id === $user->patientProfile->id;
        }

        return false;
    }

    /**
     * Check if user can modify appointment
     */
    public function canModifyAppointment($user, $appointment)
    {
        // Only doctors can modify appointment status
        if ($user->user_type === 'healthcare' && $user->identity === 'doctor') {
            return $appointment->doctor_profile_id === $user->doctorProfile->id;
        }

        return false;
    }

    /**
     * Clear appointment related cache
     */
    public function clearAppointmentRelatedCache($appointment)
    {
        // Clear appointment details cache
        Cache::forget($this->cacheKey::APPOINTMENT_DETAILS . $appointment->id);

        // Clear doctor appointments cache
        if ($appointment->doctorProfile && $appointment->doctorProfile->user) {
            $doctorUserId = $appointment->doctorProfile->user->id;
            Cache::forget($this->cacheKey::DOCTOR_APPOINTMENTS . $doctorUserId);
            Cache::forget($this->cacheKey::APPOINTMENT_STATISTICS . $doctorUserId);
        }

        // Clear patient appointments cache
        if ($appointment->patient && $appointment->patient->user) {
            $patientUserId = $appointment->patient->user->id;
            Cache::forget($this->cacheKey::PATIENT_APPOINTMENTS . $patientUserId);
            Cache::forget($this->cacheKey::APPOINTMENT_STATISTICS . $patientUserId);
        }

        foreach (Cache::getRedis()->keys($this->cacheKey::DOCTOR_LIST_SEARCH_PAGE) as $key) {
            Cache::forget(str_replace(config('cache.prefix') . ':', '', $key));
        }
    }

    /**
     * Calculate detailed appointment statistics
     */
    public function calculateDetailedStatistics($user)
    {
        if ($user->user_type === 'healthcare' && $user->identity === 'doctor') {
            return $this->calculateDoctorStatistics($user);
        } elseif ($user->user_type === 'patient') {
            return $this->calculatePatientDetailedStatistics($user);
        }

        return [];
    }

    /**
     * Fetch doctor appointments from database
     */
    public function fetchDoctorAppointments($user)
    {
        // Load doctor profile if not already loaded
        if (!$user->relationLoaded('doctorProfile')) {
            $user->load('doctorProfile');
        }

        $doctorProfile = $user->doctorProfile;

        if (!$doctorProfile) {
            return [
                'error' => 'Doctor profile not found',
                'officeAddress' => null,
                'newAppointments' => [],
                'upcomingAppointments' => [],
                'historyAppointments' => [],
                'statistics' => $this->getEmptyStatistics(),
            ];
        }

        $officeAddress = $doctorProfile->office_address;

        // Fetch different types of appointments
        $appointments = $this->getAppointmentsByType($doctorProfile->id, 'healthcare');

        return [
            'officeAddress' => $officeAddress,
            'newAppointments' => DoctorAppointmentResource::collection($appointments['new']),
            'upcomingAppointments' => DoctorAppointmentResource::collection($appointments['upcoming']),
            'historyAppointments' => DoctorAppointmentResource::collection($appointments['history']),
            'statistics' => $this->calculateAppointmentStatistics($appointments),
        ];
    }

    /**
     * Fetch patient appointments from database
     */
    public function fetchPatientAppointments($user)
    {
        if (!$user->relationLoaded('patientProfile')) {
            $user->load('patientProfile');
        }

        $patientProfile = $user->patientProfile;

        if (!$patientProfile) {
            return [
                'error' => 'Patient profile not found',
                'appointments' => [],
                'statistics' => $this->getEmptyStatistics(),
            ];
        }

        $appointments = $this->getAppointmentsByType($patientProfile->id, 'patient');

        // dd($appointments['upcoming'][1]['doctor']['user']['avatar']);

        return [
            // 'upcomingAppointments' => DoctorAppointmentResource::collection($appointments['upcoming']),
            'historyAppointments' => DoctorAppointmentResource::collection($appointments['history']),
            'statistics' => $this->calculatePatientStatistics($appointments),
        ];
    }

    /**
     * Create a new appointment
     */
    public function createAppointment($request, $user, bool $isAppRequest = false)
    {
        try {
            DB::beginTransaction();
            // Get patient profile
            $patientProfile = $user->patientProfile;

            if (!$patientProfile) {
                throw new \Exception('Patient profile not found');
            }

            // Handle file upload if exists
            $medicalProblemFilePath = null;
            if ($request->hasFile('medical_problem_file')) {
                $file = $request->file('medical_problem_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $medicalProblemFilePath = $file->move(storage_path('uploads/medical_problems'), $fileName)->getPathname();
            }

            $service = Service::findOrFail($request->service_id); // Ensure service exists

            $link = null;
            if ($service->name == "Online visit" || $service->name == "Video Appointment") {
                $link = env('APP_URL') . "/video-appointment/{$patientProfile->id}/{$service->id}";
            }
            $address = $service->name == "Home" ? $patientProfile->user->address : null;

            // Create appointment
            $appointment = Appointment::create([
                'patient_profile_id' => $patientProfile->id,
                'doctor_profile_id' => $request->doctor_profile_id,
                'service_id' => $request->service_id,
                'status' => 'pending',
                'medical_problem' => $request->medical_problem,
                'medical_problem_file' => $medicalProblemFilePath,
                'duration' => $service->duration,
                'date' => $request->date,
                'day_of_week' => $request->day_of_week,
                'time' => $request->time,
                'link' => $link,
                'address' => $address,
            ]);

            $price = $service->price < 2000 ? 2000 : $service->price;  // Cap price at 2000 for development

            $bill = Bill::create([
                'id' => time() . mt_rand(100000, 999999),
                'appointment_id' => $appointment->id,
                'payment_method' => $request->payment_method,
                'taxVAT' => $price * 0.10, // Assuming VAT is 10%
                'total' => $price + $price * 0.10,
                'status' => 'pending',
            ]);

            $total = $bill->total;
            $doctorName = $appointment->doctor->user->name ?? 'Unknown Doctor';

            $data = [
                'billId' => $bill->id,
                'amount' => $total,
                'buyerName' => $user->name,
                'buyerEmail' => $user->email,
                'buyerPhone' => $user->phone,
                'buyerAddress' => $patientProfile->user->address ?? null,
                'items' => [
                    [
                        'name' => "Appointment Booking at medlink - Dr {$doctorName} - Service: {$service->name}",
                        'price' => $price,
                        'quantity' => 1
                    ],
                    [
                        'name' => 'VAT (10%)',
                        'price' => $bill->taxVAT,
                        'quantity' => 1
                    ]
                ],
                'expiryTime' => intval(now()->addMinutes(10)->timestamp)
            ];

            $response = $this->paymentService->processAppointmentPayment($data, $request->payment_method, $isAppRequest);

            // Clear appointment and doctor list cache after successful creation
            $this->clearAppointmentRelatedCache($appointment);

            DB::commit();

            return $response;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error creating appointment: ' . $e->getMessage());
        }
    }

    /**
     * Validate appointment availability
     *
     * @param int $doctorProfileId
     * @param string $date
     * @param string $time
     * @param int $serviceId
     * @return bool
     * @throws \Exception
     */
    public function validateAppointmentAvailability($doctorProfileId, $date, $time, $serviceId)
    {
        try {
            // Check if the appointment date is in the past
            if ($date < now()->toDateString()) {
                throw new \Exception('Cannot book appointment for past dates');
            }

            // Check if the appointment is too far in the future (e.g., 3 months)
            if ($date > now()->addMonths(3)->toDateString()) {
                throw new \Exception('Cannot book appointment more than 3 months in advance');
            }

            $existingAppointments = Appointment::with('service')
                ->where('doctor_profile_id', $doctorProfileId)
                ->where('date', $date)
                ->whereIn('status', ['pending', 'upcoming'])
                ->get();

            $service = Service::find($serviceId);
            $duration = $service ? $service->duration : 30;
            $duration += 5; // Add 5 minutes buffer to avoid conflicts

            $newAppointmentStart = Carbon::parse($time)->setDateFrom($date);
            $newAppointmentEnd = $newAppointmentStart->copy()->addMinutes($duration);

            // Check for time conflicts with each existing appointment
            foreach ($existingAppointments as $appointment) {
                $existingDuration = $appointment->service ? $appointment->service->duration : 30;

                $timeRange = $appointment->time;
                $startTime = trim(explode(' - ', $timeRange)[0]);
                $existingAppointmentStart = Carbon::parse("{$date} {$startTime}");
                $existingAppointmentEnd = $existingAppointmentStart->copy()->addMinutes($existingDuration);

                // Check if appointments overlap
                if ($this->isTimeOverlapping($newAppointmentStart, $newAppointmentEnd, $existingAppointmentStart, $existingAppointmentEnd)) {
                    throw new \Exception("This time slot conflicts with an existing appointment from {$existingAppointmentStart->format('H:i')} to {$existingAppointmentEnd->format('H:i')}");
                }
            }

            return true;
        } catch (\Exception $e) {
            // Optionally log the error here
            throw new \Exception('Error validating appointment availability: ' . $e->getMessage());
        }
    }

    /**
     * Check if two time ranges overlap
     *
     * @param Carbon $start1 Start time of first range
     * @param Carbon $end1 End time of first range
     * @param Carbon $start2 Start time of second range
     * @param Carbon $end2 End time of second range
     *
     * @return bool True if ranges overlap, false otherwise
     */
    private function isTimeOverlapping($start1, $end1, $start2, $end2)
    {
        return $start1->lt($end2) && $end1->gt($start2);
    }
}
