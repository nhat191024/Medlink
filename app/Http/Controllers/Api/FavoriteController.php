<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\WorkSchedule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\Response;

class FavoriteController extends Controller
{
    /**
     * Get favorite doctors for the authenticated user
     * Caches the result for 10 minutes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoriteDoctor()
    {
        $user = Auth::user();
        $cacheKey = "favorite_doctors_user_{$user->id}";

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($user) {
            $doctors = $user->favoriteDoctors()
                ->with([
                    'doctor',
                    'doctor.doctorProfile',
                    'doctor.doctorProfile.medicalCategory',
                    'doctor.doctorProfile.appointments',
                    'doctor.doctorProfile.reviews',
                    'doctor.doctorProfile.services'
                ])
                ->get();

            $doctorsData = $doctors->map(function ($favorite) {
                $doctor = $favorite->doctor;
                $profile = $doctor->doctorProfile;

                // Cache individual doctor data
                $doctorCacheKey = "doctor_data_{$doctor->id}";
                return Cache::remember($doctorCacheKey, now()->addMinutes(15), function () use ($doctor, $profile) {
                    $medicalCategory = $profile->medicalCategory->name ?? 'N/A';

                    // Cache popularity check
                    $popularityCacheKey = "doctor_popularity_{$profile->id}";
                    $isPopular = Cache::remember($popularityCacheKey, now()->addMinutes(30), function () use ($profile) {
                        return $profile->appointments()
                            ->where('status', 1)
                            ->where('created_at', '>=', now()->subDays(7))
                            ->count() > 5;
                    });

                    // Cache rating calculation
                    $ratingCacheKey = "doctor_rating_{$profile->id}";
                    $rating = Cache::remember($ratingCacheKey, now()->addMinutes(60), function () use ($profile) {
                        $reviews = $profile->reviews;
                        return $reviews->count() > 0 ? round($reviews->sum('rate') / $reviews->count(), 1) : 0;
                    });

                    $city = $doctor->city ?? 'N/A';

                    // Cache min price
                    $minPriceCacheKey = "doctor_min_price_{$profile->id}";
                    $minPrice = Cache::remember($minPriceCacheKey, now()->addHours(2), function () use ($profile) {
                        return $profile->services ? $profile->services->min('price') : 0;
                    });

                    // Cache availability check
                    $availabilityCacheKey = "doctor_availability_{$profile->id}";
                    $isAvailable = Cache::remember($availabilityCacheKey, now()->addMinutes(5), function () use ($profile) {
                        return WorkSchedule::isAvailable($profile->id);
                    });

                    return [
                        'id' => $doctor->id,
                        'avatar' => asset($doctor->avatar),
                        'name' => $doctor->name,
                        'specialty' => $medicalCategory,
                        'is_popular' => $isPopular,
                        'rating' => $rating,
                        'city' => $city,
                        'min_price' => $minPrice,
                        'is_available' => $isAvailable,
                        'is_favorite' => true,
                    ];
                });
            });

            return response()->json($doctorsData, Response::HTTP_OK);
        });
    }

    /**
     * Clear favorite doctors cache for a specific user
     */
    public function clearFavoriteDoctorsCache($userId = null)
    {
        $userId ??= Auth::id();
        $cacheKey = "favorite_doctors_user_{$userId}";
        Cache::forget($cacheKey);
    }

    /**
     * Clear all doctor-related cache
     */
    public function clearDoctorCache($doctorId)
    {
        $cacheKeys = [
            "doctor_data_{$doctorId}",
            "doctor_popularity_{$doctorId}",
            "doctor_rating_{$doctorId}",
            "doctor_min_price_{$doctorId}",
            "doctor_availability_{$doctorId}"
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
}
