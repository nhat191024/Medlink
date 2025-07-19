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

use App\Helper\CacheKey;

class SearchController extends Controller
{
    private $workScheduleService;
    private $reviewService;
    private $cacheKey;

    public function __construct()
    {
        $this->workScheduleService = app(WorkScheduleService::class);
        $this->reviewService = app(ReviewService::class);
        $this->cacheKey = new CacheKey();
    }

    /* #region category count */

    /**
     * Get the number of each healthcare category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNumberOfEachCategory()
    {
        $cacheKey = $this->cacheKey::HEALTH_CATEGORIES_COUNT;

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
        Cache::forget($this->cacheKey::HEALTH_CATEGORIES_COUNT);

        return response()->json([
            'message' => 'Categories cache cleared successfully'
        ], Response::HTTP_OK);
    }

    /* #endregion */

    /**
     * Get doctor list with proper User and DoctorProfile relationships
     */
    public function getDoctorList(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 4);
        $search = $request->input('search', '');
        $specialty = $request->input('specialty', '');
        $location = $request->input('location', '');

        // Create cache key including search parameters
        $cacheKey = "doctor_list_search_page_{$page}_" . md5("{$search}_{$specialty}_{$location}_{$perPage}");

        // Cache for 10 minutes
        $result = Cache::remember($cacheKey, 600, fn() => $this->fetchDoctorList($perPage, $search, $specialty, $location));

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Fetch doctor list from database
     */
    private function fetchDoctorList($perPage, $search = '', $specialty = '', $location = '')
    {
        // Start building the query
        $query = User::where('identity', 'doctor')
            ->where('status', 'active')
            ->whereNotNull('name')
            ->with([
                'doctorProfile' => function ($query) {
                    $query->withCount([
                        'appointments',
                        'appointments as recent_appointments_count' => function ($q) {
                            $q->where('status', 1)
                                ->where('created_at', '>=', now()->subDays(7));
                        }
                    ]);
                },
                'doctorProfile.medicalCategory',
                'doctorProfile.services',
                'doctorProfile.workSchedules',
                'doctorProfile.reviews.patient',
                'languages.language',
                'favoriteDoctors' => function ($query) {
                    $query->where('patient_id', Auth::id());
                }
            ]);

        // Add search filters
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('doctorProfile', function ($doctorQuery) use ($search) {
                        $doctorQuery->where('introduce', 'LIKE', "%{$search}%")
                            ->orWhere('company_name', 'LIKE', "%{$search}%")
                            ->orWhere('professional_number', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Filter by specialty/medical category
        if (!empty($specialty)) {
            $query->whereHas('doctorProfile.medicalCategory', function ($categoryQuery) use ($specialty) {
                $categoryQuery->where('name', 'LIKE', "%{$specialty}%")
                    ->orWhere('id', $specialty);
            });
        }

        // Filter by location
        if (!empty($location)) {
            $query->where(function ($locationQuery) use ($location) {
                $locationQuery->where('city', 'LIKE', "%{$location}%")
                    ->orWhere('state', 'LIKE', "%{$location}%")
                    ->orWhere('address', 'LIKE', "%{$location}%")
                    ->orWhereHas('doctorProfile', function ($doctorQuery) use ($location) {
                        $doctorQuery->where('office_address', 'LIKE', "%{$location}%");
                    });
            });
        }

        // Execute query with pagination
        $users = $query->paginate($perPage);

        $doctors = $users->getCollection()->map(fn($user) => $this->transformDoctorData($user))->filter();

        return [
            'data' => $doctors,
            'total_page' => $users->lastPage(),
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
            'next_page_url' => $users->nextPageUrl(),
            'prev_page_url' => $users->previousPageUrl(),
            'search_params' => [
                'search' => $search,
                'specialty' => $specialty,
                'location' => $location,
            ]
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
        $recentAppointments = $doctorProfile->recent_appointments_count ?? 0;

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
            'latitude' => $user->latitude ?? null,
            'longitude' => $user->longitude ?? null,
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
            'total_appointments' => $doctorProfile->appointments_count ?? 0,
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

    /**
     * Search doctors by name and other criteria
     */
    public function searchDoctors(Request $request)
    {
        $searchQuery = $request->input('query', '');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);
        $specialty = $request->input('specialty', '');
        $location = $request->input('location', '');
        $minRating = $request->input('min_rating', 0);
        $maxPrice = $request->input('max_price', null);
        $isAvailable = $request->input('is_available', false);

        // Create cache key for search results
        $cacheKey = "doctor_search_" . md5($searchQuery . $specialty . $location . $minRating . $maxPrice . $isAvailable . $page . $perPage);

        // Cache search results for 5 minutes
        $result = Cache::remember($cacheKey, 300, function () use (
            $searchQuery,
            $page,
            $perPage,
            $specialty,
            $location,
            $minRating,
            $maxPrice,
            $isAvailable
        ) {
            return $this->performDoctorSearch($searchQuery, $page, $perPage, $specialty, $location, $minRating, $maxPrice, $isAvailable);
        });

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Perform doctor search with multiple criteria
     */
    private function performDoctorSearch($searchQuery, $page, $perPage, $specialty, $location, $minRating, $maxPrice, $isAvailable)
    {
        $query = User::where('identity', 'doctor')
            ->where('status', 'active')
            ->whereNotNull('name')
            ->with([
                'doctorProfile' => function ($query) {
                    $query->withCount([
                        'appointments',
                        'appointments as recent_appointments_count' => function ($q) {
                            $q->where('status', 1)
                                ->where('created_at', '>=', now()->subDays(7));
                        }
                    ]);
                },
                'doctorProfile.medicalCategory',
                'doctorProfile.services',
                'doctorProfile.workSchedules',
                'doctorProfile.reviews',
                'languages.language',
                'favoriteDoctors' => function ($query) {
                    $query->where('patient_id', Auth::id());
                }
            ]);

        // Search by name or doctor profile info
        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'LIKE', "%{$searchQuery}%")
                    ->orWhereHas('doctorProfile', function ($doctorQuery) use ($searchQuery) {
                        $doctorQuery->where('introduce', 'LIKE', "%{$searchQuery}%")
                            ->orWhere('company_name', 'LIKE', "%{$searchQuery}%")
                            ->orWhere('professional_number', 'LIKE', "%{$searchQuery}%");
                    })
                    ->orWhereHas('doctorProfile.medicalCategory', function ($categoryQuery) use ($searchQuery) {
                        $categoryQuery->where('name', 'LIKE', "%{$searchQuery}%");
                    });
            });
        }

        // Filter by specialty
        if (!empty($specialty)) {
            $query->whereHas('doctorProfile.medicalCategory', function ($categoryQuery) use ($specialty) {
                $categoryQuery->where('name', 'LIKE', "%{$specialty}%")
                    ->orWhere('id', $specialty);
            });
        }

        // Filter by location
        if (!empty($location)) {
            $query->where(function ($locationQuery) use ($location) {
                $locationQuery->where('city', 'LIKE', "%{$location}%")
                    ->orWhere('state', 'LIKE', "%{$location}%")
                    ->orWhere('address', 'LIKE', "%{$location}%")
                    ->orWhereHas('doctorProfile', function ($doctorQuery) use ($location) {
                        $doctorQuery->where('office_address', 'LIKE', "%{$location}%");
                    });
            });
        }

        // Filter by minimum rating
        if ($minRating > 0) {
            $query->whereHas('doctorProfile', function ($doctorQuery) use ($minRating) {
                $doctorQuery->whereHas('reviews', function ($reviewQuery) use ($minRating) {
                    $reviewQuery->havingRaw('AVG(rate) >= ?', [$minRating]);
                });
            });
        }

        // Filter by maximum price
        if ($maxPrice !== null) {
            $query->whereHas('doctorProfile.services', function ($serviceQuery) use ($maxPrice) {
                $serviceQuery->where('price', '<=', $maxPrice);
            });
        }

        // Filter by availability
        if ($isAvailable) {
            $today = now()->format('l');
            $query->whereHas('doctorProfile.workSchedules', function ($scheduleQuery) use ($today) {
                $scheduleQuery->where('day_of_week', $today)
                    ->where('is_active', true);
            });
        }

        // Execute query with pagination
        $users = $query->paginate($perPage, ['*'], 'page', $page);

        $doctors = $users->getCollection()->map(function ($user) {
            return $this->transformDoctorData($user);
        })->filter();

        return [
            'data' => $doctors,
            'total_page' => $users->lastPage(),
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
            'next_page_url' => $users->nextPageUrl(),
            'prev_page_url' => $users->previousPageUrl(),
            'search_params' => [
                'query' => $searchQuery,
                'specialty' => $specialty,
                'location' => $location,
                'min_rating' => $minRating,
                'max_price' => $maxPrice,
                'is_available' => $isAvailable,
            ],
            'has_results' => $doctors->isNotEmpty(),
            'search_suggestions' => $this->getSearchSuggestions($searchQuery),
        ];
    }

    /**
     * Get search suggestions based on query
     */
    private function getSearchSuggestions($query)
    {
        if (empty($query) || strlen($query) < 2) {
            return [];
        }

        $suggestions = [];

        // Get doctor name suggestions
        $doctorNames = User::where('identity', 'doctor')
            ->where('status', 'active')
            ->where('name', 'LIKE', "%{$query}%")
            ->pluck('name')
            ->unique()
            ->take(3)
            ->toArray();

        // Get specialty suggestions
        $specialties = \App\Models\MedicalCategory::where('name', 'LIKE', "%{$query}%")
            ->pluck('name')
            ->unique()
            ->take(3)
            ->toArray();

        return [
            'doctors' => $doctorNames,
            'specialties' => $specialties,
        ];
    }

    /**
     * Get popular search terms
     */
    public function getPopularSearchTerms()
    {
        $cacheKey = 'popular_search_terms';

        return Cache::remember($cacheKey, 3600, function () {
            // Get most common specialties
            $popularSpecialties = \App\Models\MedicalCategory::withCount('doctorProfiles')
                ->orderBy('doctor_profiles_count', 'desc')
                ->take(5)
                ->pluck('name')
                ->toArray();

            // Get most common locations
            $popularLocations = User::where('identity', 'doctor')
                ->where('status', 'active')
                ->whereNotNull('city')
                ->groupBy('city')
                ->selectRaw('city, COUNT(*) as count')
                ->orderBy('count', 'desc')
                ->take(5)
                ->pluck('city')
                ->toArray();

            return [
                'specialties' => $popularSpecialties,
                'locations' => $popularLocations,
            ];
        });
    }
}
