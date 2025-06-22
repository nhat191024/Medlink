<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\WorkSchedule;

use App\Http\Resources\ServiceCollection;
use App\Http\Services\ReviewService;
use App\Http\Services\WorkScheduleService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    private $workScheduleService;
    private $reviewService;

    public function __construct()
    {
        $this->workScheduleService = app(WorkScheduleService::class);
        $this->reviewService = app(ReviewService::class);
    }

    /**
     * Get the number of each healthcare category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNumberOfEachCategory()
    {
        $cacheKey = 'healthcare_categories_count';

        // Cache for 15 minutes (900 seconds)
        $categories = Cache::remember($cacheKey, 900, function () {
            return $this->calculateCategoryCounts();
        });

        return response()->json($categories, Response::HTTP_OK);
    }

    /**
     * Calculate healthcare category counts
     *
     * @return array
     */
    private function calculateCategoryCounts()
    {
        $baseQuery = User::where('status', 'active');

        $categories = [
            'doctor' => 'doctor',
            'pharmacies' => 'pharmacies',
            'hospital' => 'hospital',
            'ambulance' => 'ambulance'
        ];

        $results = [];

        foreach ($categories as $key => $identity) {
            $results[$key] = (clone $baseQuery)->where('identity', $identity)->count();
        }

        $results['total'] = array_sum($results);
        $results['last_updated'] = now()->toISOString();

        return $results;
    }

    /**
     * Clear healthcare categories cache
     */
    public function clearCategoriesCache()
    {
        Cache::forget('healthcare_categories_count');

        return response()->json([
            'message' => 'Categories cache cleared successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Get doctor list with proper User and DoctorProfile relationships
     */
    public function getDoctorList(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 4);
        $cacheKey = "doctor_list_page_{$page}_per_{$perPage}";

        // Cache for 10 minutes
        $result = Cache::remember($cacheKey, 600, fn() => $this->fetchDoctorList($perPage));

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Fetch doctor list from database
     */
    private function fetchDoctorList($perPage)
    {
        // Get users with doctor identity and their doctor profiles
        $users = User::where('identity', 'doctor')
            ->where('status', 'active')
            ->whereNotNull('name')
            ->with([
                'doctorProfile.medicalCategory',
                'doctorProfile.services',
                'doctorProfile.workSchedules',
                'doctorProfile.appointments',
                'doctorProfile.reviews.patient',
                'languages.language',
                'favoriteDoctors' => function ($query) {
                    $query->where('patient_id', Auth::id());
                }
            ])
            ->paginate($perPage);

        $doctors = $users->getCollection()->map(fn($user) => $this->transformDoctorData($user));

        return [
            'data' => $doctors,
            'total_page' => $users->lastPage(),
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
            'next_page_url' => $users->nextPageUrl(),
            'prev_page_url' => $users->previousPageUrl(),
        ];
    }

    /**
     * Transform doctor user data for API response
     */
    private function transformDoctorData($user)
    {
        $doctorProfile = $user->doctorProfile;

        if (!$doctorProfile) {
            return null; // Skip users without doctor profile
        }

        // Calculate availability
        $isAvailable = WorkSchedule::isAvailable($doctorProfile->id);

        // Get work schedule
        $workSchedule = $this->workScheduleService->getAvailableWorkSchedule(
            $doctorProfile->workSchedules,
            $doctorProfile->id
        );

        // Process reviews
        $reviews = $doctorProfile->reviews;
        $reviewStats = $this->calculateReviewStats($reviews);
        $testimonials = $this->reviewService->getTestimonials($reviews);
        $topReviews = $this->reviewService->getTopReviews($reviews);

        // Check popularity (more than 5 appointments in last 7 days)
        $recentAppointments = $doctorProfile->appointments()
            ->where('status', 1)
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        return [
            'id' => $user->id,
            'doctor_profile_id' => $doctorProfile->id,
            'avatar' => $user->avatar ? asset($user->avatar) : null,
            'name' => $user->name,
            'specialty' => $doctorProfile->medicalCategory ? $doctorProfile->medicalCategory->name : 'N/A',
            'introduce' => $doctorProfile->introduce ?? 'N/A',
            'professional_number' => $doctorProfile->professional_number,
            'office_address' => $doctorProfile->office_address,
            'company_name' => $doctorProfile->company_name,
            'is_popular' => $recentAppointments > 5,
            'rating' => $reviewStats['average_rating'],
            'total_rate' => $reviewStats['total_reviews'],
            'location' => $user->city ?? 'N/A',
            'min_price' => $doctorProfile->services->isNotEmpty() ? $doctorProfile->services->min('price') : 0,
            'max_price' => $doctorProfile->services->isNotEmpty() ? $doctorProfile->services->max('price') : 0,
            'is_available' => $isAvailable,
            'is_favorite' => $user->favoriteDoctors->isNotEmpty(),
            'coordinates' => [
                'latitude' => $user->latitude ?? null,
                'longitude' => $user->longitude ?? null,
            ],
            'languages' => $user->languages->map(function ($userLanguage) {
                return [
                    'code' => $userLanguage->language->code ?? null,
                    'name' => $userLanguage->language->name ?? null,
                ];
            }),
            'services' => new ServiceCollection($doctorProfile->services),
            'work_schedule' => $workSchedule,
            'testimonials' => $testimonials,
            'top_reviews' => $topReviews,
            'total_appointments' => $doctorProfile->appointments->count(),
            'recent_appointments' => $recentAppointments,
        ];
    }

    /**
     * Calculate review statistics
     */
    private function calculateReviewStats($reviews)
    {
        $totalReviews = $reviews->count();

        if ($totalReviews === 0) {
            return [
                'average_rating' => 0,
                'total_reviews' => 0,
            ];
        }

        $totalRating = $reviews->sum('rate');
        $averageRating = round($totalRating / $totalReviews, 1);

        return [
            'average_rating' => $averageRating,
            'total_reviews' => $totalReviews,
        ];
    }

    /**
     * Clear doctor list cache
     */
    public function clearDoctorListCache()
    {
        // Clear all doctor list cache keys
        $cacheKeys = Cache::get('doctor_list_cache_keys', []);

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }

        Cache::forget('doctor_list_cache_keys');

        return response()->json([
            'message' => 'Doctor list cache cleared successfully'
        ], Response::HTTP_OK);
    }
}
