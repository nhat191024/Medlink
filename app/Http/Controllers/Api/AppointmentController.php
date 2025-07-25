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

use App\Http\Requests\BookAppointment;
use App\Models\Review;

use App\Helper\CacheKey;

class AppointmentController extends Controller
{
    private $appointmentService;
    private $cacheKey;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
        $this->cacheKey = new CacheKey();
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
        $cacheKey = $this->cacheKey::DOCTOR_APPOINTMENTS . $userId;

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
        $cacheKey = $this->cacheKey::PATIENT_APPOINTMENTS . $userId;

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
            $cacheKeys[] = $this->cacheKey::DOCTOR_APPOINTMENTS . $userId;
        } elseif ($user->user_type === 'patient') {
            $cacheKeys[] = $this->cacheKey::PATIENT_APPOINTMENTS . $userId;
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
        $cacheKey = $this->cacheKey::APPOINTMENT_DETAILS . $appointmentId;

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
    public function updateAppointmentStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required|integer|exists:appointments,id',
            'status' => 'required|in:pending,upcoming,completed,cancelled,rejected',
            'reason' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $appointment = Appointment::find($request->input('appointment_id'));

        if (!$appointment) {
            return response()->json([
                'message' => 'Appointment not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // Check permissions
        $user = Auth::user();
        if ($request->input('status') != "cancelled" && !$this->appointmentService->canModifyAppointment($user, $appointment)) {
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
        $cacheKey = $this->cacheKey::APPOINTMENT_STATISTICS . $userId;

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
            $this->cacheKey::DOCTOR_APPOINTMENTS . $user->id,
            $this->cacheKey::PATIENT_APPOINTMENTS . $user->id,
            $this->cacheKey::APPOINTMENT_STATISTICS . $user->id,
        ];

        foreach ($cachePatterns as $pattern) {
            Cache::forget($pattern);
        }

        return response()->json([
            'message' => 'All appointment caches cleared successfully'
        ], Response::HTTP_OK);
    }

    /**
     *  Add a new appointment with validation
     *
     * @param \App\Http\Requests\BookAppointment $request
     */
    public function bookAppointment(BookAppointment $request)
    {
        $user = Auth::user();

        // Check if the user is a patient
        if ($user->user_type !== 'patient') {
            return response()->json([
                'message' => 'Unauthorized access'
            ], Response::HTTP_FORBIDDEN);
        }

        try {
            // Validate appointment availability
            $this->appointmentService->validateAppointmentAvailability(
                $request->input('doctor_profile_id'),
                $request->input('date'),
                $request->input('start_time'),
                $request->input('service_id')
            );

            // Create the appointment
            $response = $this->appointmentService->createAppointment($request, $user, true);

            return response()->json([
                'message' => 'Appointment booked successfully',
                'data' => $response
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to book appointment',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Add a review for an appointment
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required|integer|exists:appointments,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
            'recommend' => 'required|string|in:true,false',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $appointmentId = $request->input('appointment_id');
        $appointment = Appointment::find($appointmentId);
        $user = Auth::user();
        $patientProfileId = $user->patientProfile->id;
        $doctorProfileId = $appointment->doctorProfile->id;

        // Create the review
        $review = Review::create([
            'doctor_profile_id' => $doctorProfileId,
            'patient_profile_id' => $patientProfileId,
            'appointment_id' => $appointmentId,
            'rate' => $request->input('rating'),
            'review' => $request->input('review'),
            'recommend' => $request->input('recommend') == 'true' ? true : false,
        ]);

        return response()->json([
            'message' => 'Review added successfully',
            'data' => $review
        ], Response::HTTP_CREATED);
    }
}
