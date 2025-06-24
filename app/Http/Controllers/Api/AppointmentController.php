<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Service\WorkScheduleService;
use App\Http\Services\AppointmentService;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

use App\Models\Appointment;

use App\Http\Resources\DoctorAppointmentResource;
use App\Http\Resources\PatientAppointmentResource;

class AppointmentController extends Controller
{
    private $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    /**
     * Get doctor appointments with caching
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorAppointments()
    {
        $user = Auth::user();
        $userId = $user->id;
        $cacheKey = "doctor_appointments_{$userId}";

        // Cache for 5 minutes (300 seconds)
        $appointmentData = Cache::remember($cacheKey, 300, function () use ($user) {
            return $this->appointmentService->fetchDoctorAppointments($user);
        });

        return response()->json($appointmentData, Response::HTTP_OK);
    }

    /**
     * Get patient appointments with caching
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientAppointments()
    {
        $user = Auth::user();
        $userId = $user->id;
        $cacheKey = "patient_appointments_{$userId}";

        // Cache for 5 minutes
        $appointmentData = Cache::remember($cacheKey, 300, function () use ($user) {
            return $this->appointmentService->fetchPatientAppointments($user);
        });

        return response()->json($appointmentData, Response::HTTP_OK);
    }

    /**
     * Clear appointment cache for current user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearAppointmentCache()
    {
        $userId = Auth::id();
        $user = Auth::user();

        $cacheKeys = [];

        if ($user->user_type === 'healthcare' && $user->identity === 'doctor') {
            $cacheKeys[] = "doctor_appointments_{$userId}";
        } elseif ($user->user_type === 'patient') {
            $cacheKeys[] = "patient_appointments_{$userId}";
        }

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }

        return response()->json([
            'message' => 'Appointment cache cleared successfully',
            'cleared_keys' => $cacheKeys
        ], Response::HTTP_OK);
    }

    /**
     * Get appointment details with caching
     *
     * @param int $appointmentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAppointmentDetails($appointmentId)
    {
        $cacheKey = "appointment_details_{$appointmentId}";

        $appointment = Cache::remember($cacheKey, 600, function () use ($appointmentId) {
            return Appointment::with([
                'patient.user',
                'doctorProfile.user',
                'service',
                'bill'
            ])->find($appointmentId);
        });

        if (!$appointment) {
            return response()->json([
                'message' => 'Appointment not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // Check if user has permission to view this appointment
        $user = Auth::user();
        if (!$this->appointmentService->canViewAppointment($user, $appointment)) {
            return response()->json([
                'message' => 'Unauthorized access'
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([
            'appointment' => new DoctorAppointmentResource($appointment)
        ], Response::HTTP_OK);
    }

    /**
     * Update appointment status with cache invalidation
     *
     * @param int $appointmentId
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAppointmentStatus($appointmentId, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,upcoming,completed,cancelled,rejected',
            'reason' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $appointment = Appointment::find($appointmentId);

        if (!$appointment) {
            return response()->json([
                'message' => 'Appointment not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // Check permissions
        $user = Auth::user();
        if (!$this->appointmentService->canModifyAppointment($user, $appointment)) {
            return response()->json([
                'message' => 'Unauthorized access'
            ], Response::HTTP_FORBIDDEN);
        }

        // Update appointment
        $appointment->update([
            'status' => $request->input('status'),
            'reason' => $request->input('reason', null),
        ]);

        // Clear relevant caches
        $this->appointmentService->clearAppointmentRelatedCache($appointment);

        return response()->json([
            'message' => 'Appointment status updated successfully',
            'appointment' => new DoctorAppointmentResource($appointment->fresh())
        ], Response::HTTP_OK);
    }

    /**
     * Get appointment statistics with caching
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAppointmentStatistics()
    {
        $user = Auth::user();
        $userId = $user->id;
        $cacheKey = "appointment_statistics_{$userId}";

        $statistics = Cache::remember($cacheKey, 900, function () use ($user) {
            return $this->appointmentService->calculateDetailedStatistics($user);
        });

        return response()->json($statistics, Response::HTTP_OK);
    }

    /**
     * Clear all appointment caches
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearAllAppointmentCaches()
    {
        $user = Auth::user();

        // Define cache patterns to clear
        $cachePatterns = [
            "doctor_appointments_{$user->id}",
            "patient_appointments_{$user->id}",
            "appointment_statistics_{$user->id}",
        ];

        foreach ($cachePatterns as $pattern) {
            Cache::forget($pattern);
        }

        return response()->json([
            'message' => 'All appointment caches cleared successfully'
        ], Response::HTTP_OK);
    }
}
