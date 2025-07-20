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

use App\Helper\CacheKey;

class FavoriteController extends Controller
{
    private $cacheKey;

    public function __construct()
    {
        $this->cacheKey = new CacheKey();
    }

    /**
     * Get favorite doctors for the authenticated user
     * Caches the result for 10 minutes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFavoriteDoctor()
    {
        $user = Auth::user();
        $cacheKey = $this->cacheKey::FAVORITE_DOCTORS . $user->id;

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

                $medicalCategory = $profile->medicalCategory->name ?? 'N/A';
                $isPopular = $profile->appointments()
                    ->where('status', 1)
                    ->where('created_at', '>=', now()->subDays(7))
                    ->count() > 5;

                $reviews = $profile->reviews;
                $rating = $reviews->count() > 0 ? round($reviews->sum('rate') / $reviews->count(), 1) : 0;

                $city = $doctor->city ?? 'N/A';
                $minPrice = $profile->services ? $profile->services->min('price') : 0;
                $isAvailable = WorkSchedule::isAvailable($profile->id);

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

            return response()->json($doctorsData, Response::HTTP_OK);
        });
    }

    /**
     * Clear favorite doctors cache for a specific user
     */
    public function clearFavoriteDoctorsCache($userId = null)
    {
        $userId ??= Auth::id();
        $cacheKey = $this->cacheKey::FAVORITE_DOCTORS . $userId;
        Cache::forget($cacheKey);
    }

    /**
     * Add a doctor to the user's favorites
     *
     * @param int $doctorId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFavoriteDoctor(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|integer|exists:doctors,id',
        ]);

        $doctorId = $request->input('doctor_id');

        $user = Auth::user();
        $doctor = $user->favoriteDoctors()->where('doctor_id', $doctorId)->first();

        if ($doctor) {
            return response()->json(
                ['message' => 'Doctor already in favorites'],
                Response::HTTP_OK
            );
        }

        try {
            DB::beginTransaction();

            $user->favoriteDoctors()->attach($doctorId);

            $this->clearFavoriteDoctorsCache($user->id);

            DB::commit();
            return response()->json(['message' => 'Doctor added to favorites'], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding favorite doctor: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding favorite doctor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
