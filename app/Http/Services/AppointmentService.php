<?php

namespace App\Http\Services;

use App\Models\Appointment;
use App\Http\Resources\DoctorAppointmentResource;
use Illuminate\Support\Facades\Cache;

class AppointmentService
{
    /**
     * Get appointments by type for a doctor profile
     */
    public function getAppointmentsByType($doctorProfileId)
    {
        $baseQuery = Appointment::with(['patient.user', 'service', 'bill'])
            ->where('doctor_profile_id', $doctorProfileId);

        return [
            'new' => (clone $baseQuery)
                ->where('status', 'pending')
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get(),

            'upcoming' => (clone $baseQuery)
                ->where('status', 'upcoming')
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get(),

            'history' => (clone $baseQuery)
                ->whereIn('status', ['cancelled', 'rejected', 'completed'])
                ->orderBy('date', 'desc')
                ->orderBy('time', 'desc')
                ->limit(50) // Limit history to last 50 records for performance
                ->get(),
        ];
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
        $upcoming = $appointments->whereIn('status', ['pending', 'upcoming'])
            ->where('date', '>=', now()->toDateString())
            ->count();

        $completed = $appointments->where('status', 'completed')->count();
        $cancelled = $appointments->where('status', 'cancelled')->count();

        return [
            'total_upcoming' => $upcoming,
            'total_completed' => $completed,
            'total_cancelled' => $cancelled,
            'total_appointments' => $appointments->count(),
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
        Cache::forget("appointment_details_{$appointment->id}");

        // Clear doctor appointments cache
        if ($appointment->doctorProfile && $appointment->doctorProfile->user) {
            $doctorUserId = $appointment->doctorProfile->user->id;
            Cache::forget("doctor_appointments_{$doctorUserId}");
            Cache::forget("appointment_statistics_{$doctorUserId}");
        }

        // Clear patient appointments cache
        if ($appointment->patient && $appointment->patient->user) {
            $patientUserId = $appointment->patient->user->id;
            Cache::forget("patient_appointments_{$patientUserId}");
            Cache::forget("appointment_statistics_{$patientUserId}");
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
        $appointments = $this->getAppointmentsByType($doctorProfile->id);

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

        $appointments = Appointment::with(['doctorProfile.user', 'service', 'bill'])
            ->where('patient_profile_id', $patientProfile->id)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        $groupedAppointments = [
            'upcoming' => $appointments->whereIn('status', ['pending', 'upcoming'])
                ->where('date', '>=', now()->toDateString()),
            'history' => $appointments->whereIn('status', ['cancelled', 'rejected', 'completed'])
        ];

        return [
            'upcomingAppointments' => DoctorAppointmentResource::collection($groupedAppointments['upcoming']),
            'historyAppointments' => DoctorAppointmentResource::collection($groupedAppointments['history']),
            'statistics' => $this->calculatePatientStatistics($appointments),
        ];
    }
}
