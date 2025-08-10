<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Http\Services\UserService;
use App\Http\Services\ProfileService;

use Symfony\Component\HttpFoundation\Response;

use App\Helper\CacheKey;

class DashboardController extends Controller
{
    private $userService;
    private $profileService;
    private $cacheKey;

    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->profileService = app(ProfileService::class);
        $this->cacheKey = new CacheKey();
    }

    /**
     * Display the patient summary.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientSummary()
    {
        $user = Auth::user();

        // Cache profile data (rarely changes)
        $profileCacheKey = $this->cacheKey::PATIENT_PROFILE_DATA . $user->id;
        $profileData = Cache::rememberForever($profileCacheKey, function () use ($user) {
            $userAvatar = $user->avatar ? asset($user->avatar) : null;
            $location = trim(($user->city ?? '') . ', ' . ($user->country ?? ''), ', ');

            return [
                'avatar' => $userAvatar,
                'name' => $user->name ?? 'Not provided',
                'email' => $user->email ?? 'Not provided',
                'phone' => $user->phone ?? 'Not provided',
                'address' => $user->address ?? 'Not provided',
                'gps' => ($user->latitude && $user->longitude) ? "{$user->latitude}, {$user->longitude}" : 'Not provided',
                'country' => $user->country ?? 'Not provided',
                'city' => $user->city ?? 'Not provided',
                'state' => $user->state ?? 'Not provided',
                'zip_code' => $user->zip_code ?? 'Not provided',
                'userType' => $user->user_type ?? 'Not provided',
                'location' => $location ?: 'Not provided',
            ];
        });

        // Cache notification data for 2 minutes (frequently changes)
        $notificationCacheKey = $this->cacheKey::PATIENT_NOTIFICATIONS . $user->id;
        $notificationData = Cache::remember($notificationCacheKey, now()->addMinutes(2), function () use ($user) {
            $user = $user->fresh(['notification']);
            $notifications = $user->notification ?? collect();

            return [
                'isHaveNotification' => $notifications->where('status', 'unread')->count() > 0,
            ];
        });

        $userBalance = ['balance' => $user->balance];

        // Merge all cached data
        // $summary = array_merge($profileData, $notificationData, $userBalance);
        $summary = [];

        return response()->json($summary, Response::HTTP_OK);
    }

    /**
     * Display the doctor summary.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorSummary()
    {
        $user = Auth::user();

        $profileCacheKey = $this->cacheKey::DOCTOR_SUMMARY . $user->id;
        $profileData = Cache::rememberForever($profileCacheKey, function () use ($user) {
            $user = $user->load([
                'doctorProfile',
                'doctorProfile.medicalCategory',
                'doctorProfile.reviews'
            ]);
            $doctorProfile = $user->doctorProfile;

            // User basic info
            $avatar = $user->avatar ? asset($user->avatar) : null;
            $identity = $user->identity ?? 'Not specified';
            $name = $this->userService->formatDoctorName($user->name, $identity);
            $specialty = $doctorProfile->medicalCategory->name ?? 'Not specified';
            $hasIntroduction = !empty($doctorProfile->introduce);
            $introduction = $doctorProfile->introduce ?? null;

            // Reviews (ít thay đổi)
            $reviewsCount = $doctorProfile->reviews->count();
            $reviewerAvatars = $this->userService->getReviewerAvatars($doctorProfile->reviews);

            $profileSetupPoint = $this->profileService->calculateProfileCompletion($user);

            return [
                'avatar' => $avatar,
                'name' => $name,
                'identity' => $identity,
                'specialty' => $specialty,
                'userType' => $user->user_type ?? 'Not provided',
                'introduce' => $introduction,
                'reviews' => $reviewsCount,
                'reviewer' => $reviewerAvatars,
                'hasIntroduction' => $hasIntroduction,
                'profileSetupPoint' => $profileSetupPoint,
            ];
        });

        // Cache appointment data for 5 minutes
        $appointmentCacheKey = $this->cacheKey::DOCTOR_APPOINTMENTS_SUMMARY . $user->id;
        $appointmentData = Cache::remember($appointmentCacheKey, now()->addMinutes(5), function () use ($user) {
            $user = $user->load(['doctorProfile.appointments']);
            $appointments = $user->doctorProfile->appointments ?? collect();

            return [
                'pending' => $appointments->where('status', 'pending')->count(),
                'upcoming' => $appointments->where('status', 'upcoming')->count(),
            ];
        });

        // Cache notification data for 2 minutes
        $notificationCacheKey = $this->cacheKey::DOCTOR_NOTIFICATIONS . $user->id;
        $notificationData = Cache::remember($notificationCacheKey, now()->addMinutes(2), function () use ($user) {
            $user = $user->fresh(['notification']);
            $notifications = $user->notification ?? collect();

            return [
                'isHaveNotification' => $notifications->where('status', 'unread')->count() > 0,
            ];
        });

        $userBalance = ['balance' => $user->balance];

        // Merge all cached data
        // $summary = array_merge($profileData, $appointmentData, $notificationData, $userBalance);
        $summary = [];

        return response()->json($summary, Response::HTTP_OK);
    }

    /**
     * Refresh cache manually - API endpoint for manual cache refresh
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshCache()
    {
        $user = Auth::user();

        $this->userService->clearUserSummaryCache($user->id);

        return response()->json(['message' => 'Cache refreshed successfully'], Response::HTTP_OK);
    }
}
