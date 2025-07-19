<?php

namespace App\Http\Controllers\Api;

use App\Models\WorkSchedule;

use App\Http\Controllers\Controller;

use App\Http\Resources\DoctorProfileResource;
use App\Http\Resources\PatientProfileResource;
use App\Http\Requests\DoctorEditProfileRequest;
use App\Http\Requests\PatientEditProfileRequest;
use App\Http\Services\ProfileService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use Symfony\Component\HttpFoundation\Response;

use App\Helper\CacheKey;

class ProfileController extends Controller
{
    private $profileService;
    private $cacheKey;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
        $this->cacheKey = new CacheKey();
    }

    /**
     * Get doctor profile with caching
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorProfile()
    {
        $user = Auth::user();
        $userId = $user->id;
        $doctorProfile = $user->doctorProfile;
        $cacheKey = $this->cacheKey::DOCTOR_PROFILE . $userId;

        $isAvailable = WorkSchedule::isAvailable($doctorProfile->id);

        // Cache for 10 minutes
        $profileData = Cache::remember($cacheKey, 600, fn() => $this->profileService->fetchDoctorProfileData($user));

        if (isset($profileData['error'])) {
            return response()->json([
                'message' => $profileData['error'],
                'profile' => null,
                'languages' => [],
                'workSchedule' => null,
                'services' => null,
            ], Response::HTTP_NOT_FOUND);
        }

        if ($user->user_type !== 'healthcare' || $user->identity !== 'doctor') {
            return response()->json([
                'profile' => new DoctorProfileResource($user),
                'languages' => $profileData['languages'],
                'workSchedule' => null,
                'services' => null,
                'message' => 'Limited profile data - not a doctor account'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'profile' => new DoctorProfileResource($profileData['profile']),
            'isAvailable' => $isAvailable,
            'languages' => $profileData['languages'],
            'workSchedule' => $profileData['workSchedule'],
            'services' => $profileData['services'],
            'reviewCounts' => $profileData['reviewCounts'],
            'avgTotal' => $profileData['avgTotal'],
            'reviews' => $profileData['reviews'],
            'allReviews' => $profileData['allReviews'],
            'testimonials' => $profileData['testimonials'],
            'statistics' => $profileData['statistics'],
        ], Response::HTTP_OK);
    }

    /**
     * Get patient profile with caching
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientProfile()
    {
        $user = Auth::user();
        $userId = $user->id;
        $cacheKey = $this->cacheKey::PATIENT_PROFILE . $userId;

        // Cache for 10 minutes
        $profileData = Cache::remember($cacheKey, 600, function () use ($user) {
            return $this->profileService->fetchPatientProfileData($user);
        });

        if (isset($profileData['error'])) {
            return response()->json([
                'message' => $profileData['error'],
                'profile' => null,
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'profile' => new PatientProfileResource($profileData['profile']),
            'languages' => $profileData['languages'],
            'statistics' => $profileData['statistics'],
        ], Response::HTTP_OK);
    }

    /**
     * Clear profile cache
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearProfileCache()
    {
        $user = Auth::user();

        $this->profileService->clearProfileCache($user->id);

        return response()->json([
            'message' => 'Profile cache cleared successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Get profile statistics
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfileStatistics()
    {
        $user = Auth::user();
        $userId = $user->id;
        $cacheKey = $this->cacheKey::PROFILE_STATISTICS . $userId;

        $statistics = Cache::remember($cacheKey, 600, function () use ($user) {
            if ($user->user_type === 'healthcare' && $user->identity === 'doctor') {
                $user->load('doctorProfile.appointments', 'doctorProfile.reviews', 'doctorProfile.services');
                return $this->profileService->calculateProfileStatistics($user->doctorProfile);
            } elseif ($user->user_type === 'patient') {
                return $this->profileService->calculatePatientStatistics($user);
            }

            return [];
        });

        return response()->json($statistics, Response::HTTP_OK);
    }

    /**
     * Edit doctor profile
     *
     * @param DoctorEditProfileRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorEditProfile(DoctorEditProfileRequest $request)
    {
        $user = Auth::user();

        // Verify user is a doctor
        if ($user->user_type !== 'healthcare' || $user->identity !== 'doctor') {
            return response()->json([
                'message' => 'Unauthorized. Only doctors can access this endpoint.'
            ], Response::HTTP_FORBIDDEN);
        }

        $profileData = $this->profileService->updateDoctorProfile($user, $request->validated());

        if (isset($profileData['error'])) {
            return response()->json([
                'message' => $profileData['error']
            ], Response::HTTP_BAD_REQUEST);
        }

        // Clear profile cache
        $this->profileService->clearProfileCache($user->id);

        return response()->json([
            'message' => 'Doctor profile updated successfully',
            'profile' => $profileData['profile']
        ], Response::HTTP_OK);
    }

    /**
     * Edit patient profile
     *
     * @param PatientEditProfileRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientEditProfile(PatientEditProfileRequest $request)
    {
        $user = Auth::user();

        // Verify user is a patient
        if ($user->user_type !== 'patient') {
            return response()->json([
                'message' => 'Unauthorized. Only patients can access this endpoint.'
            ], Response::HTTP_FORBIDDEN);
        }

        $profileData = $this->profileService->updatePatientProfile($user, $request->validated());

        if (isset($profileData['error'])) {
            return response()->json([
                'message' => $profileData['error']
            ], Response::HTTP_BAD_REQUEST);
        }

        // Clear profile cache
        $this->profileService->clearProfileCache($user->id);

        return response()->json([
            'message' => 'Patient profile updated successfully',
            'profile' => $profileData['profile']
        ], Response::HTTP_OK);
    }
}
