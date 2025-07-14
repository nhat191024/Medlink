<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Language;
use App\Models\MedicalCategory;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use App\Http\Services\ReviewService;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

use function Pest\Laravel\json;

class ProfileService
{
    private $reviewService;

    public function __construct()
    {
        $this->reviewService = app(ReviewService::class);
    }

    /**
     * Get doctor profile data with caching
     */
    public function getDoctorProfileData($user, $cacheKey = null)
    {
        if ($cacheKey) {
            return Cache::remember($cacheKey, 600, function () use ($user) {
                return $this->fetchDoctorProfileData($user);
            });
        }

        return $this->fetchDoctorProfileData($user);
    }

    /**
     * Fetch doctor profile data from database
     */
    private function fetchDoctorProfileData($user)
    {
        // Load necessary relationships
        $user->load([
            'doctorProfile.medicalCategory',
            'doctorProfile.services',
            'doctorProfile.workSchedules',
            'doctorProfile.reviews.patient',
            'languages.language'
        ]);

        $doctorProfile = $user->doctorProfile;

        if (!$doctorProfile) {
            return [
                'error' => 'Doctor profile not found',
                'profile' => null,
                'languages' => [],
                'workSchedule' => null,
                'services' => null,
                'reviews' => [],
                'statistics' => $this->getEmptyStatistics(),
            ];
        }

        // Get languages
        $languages = $this->formatLanguages($user->languages);

        // Get work schedules
        $workSchedules = $this->formatWorkSchedules($doctorProfile->workSchedules);

        // Get services
        $services = $doctorProfile->services->map(fn($service) => [
            'id' => $service->id,
            'name' => $service->name,
            'description' => $service->description,
            'price' => $service->price,
            'duration' => $service->duration,
            'buffer_time' => $service->buffer_time,
            'is_active' => $service->is_active == 1 ? true : false,
            'icon' => $service->icon,
            'seat' => $service->seat,
            'created_at' => $service->created_at,
            'updated_at' => $service->updated_at,
        ]);

        // Get reviews data
        $reviewsData = $this->processReviews($doctorProfile->reviews);

        return [
            'profile' => $doctorProfile,
            'languages' => $languages,
            'workSchedule' => $workSchedules,
            'services' => $services,
            'reviewCounts' => $reviewsData['count'],
            'avgTotal' => $reviewsData['average'],
            'reviews' => $reviewsData['top_reviews'],
            'allReviews' => $reviewsData['all_reviews'],
            'testimonials' => $reviewsData['rating_distribution'],
            'statistics' => $this->calculateProfileStatistics($doctorProfile),
        ];
    }

    /**
     * Format user languages
     */
    public function formatLanguages($userLanguages)
    {
        return $userLanguages->map(function ($userLanguage) {
            return [
                'code' => $userLanguage->language->code ?? null,
                'name' => $userLanguage->language->name ?? null,
            ];
        })->values();
    }

    /**
     * Format work schedules
     */
    public function formatWorkSchedules($workSchedules)
    {
        $workScheduleService = app(\App\Http\Services\WorkScheduleService::class);
        return $workScheduleService->getSortedGroupedWorkSchedule($workSchedules);
    }

    /**
     * Process reviews data
     */
    public function processReviews($reviews)
    {
        $reviewsWithPatient = $reviews->load('patient.user');
        $reviewCount = $reviews->count();

        if ($reviewCount === 0) {
            return [
                'count' => 0,
                'average' => 0,
                'top_reviews' => [],
                'all_reviews' => [],
                'rating_distribution' => $this->getEmptyRatingDistribution(),
            ];
        }

        $avgTotal = number_format($reviews->avg('rate'), 1);

        // Sort reviews by rating and creation date
        $sortedReviews = $reviewsWithPatient->sortByDesc(function ($review) {
            return [$review->rate, $review->created_at];
        })->values();

        // Get top 2 reviews
        $topReviews = $sortedReviews->take(2)->map(function ($review) {
            return $this->formatReview($review);
        });

        // Get all reviews
        $allReviews = $sortedReviews->map(function ($review) {
            return $this->formatReview($review);
        });

        // Calculate rating distribution
        $ratingDistribution = $this->reviewService->getTestimonials($reviews);

        return [
            'count' => $reviewCount,
            'average' => $avgTotal,
            'top_reviews' => $topReviews,
            'all_reviews' => $allReviews,
            'rating_distribution' => $ratingDistribution,
        ];
    }

    /**
     * Format single review
     */
    private function formatReview($review)
    {
        return [
            'id' => $review->id,
            'rate' => $review->rate,
            'review' => $review->review,
            'full_name' => $review->patient->user->name ?? 'Anonymous',
            'avatar' => $review->patient->user->avatar ? asset($review->patient->user->avatar) : '',
            'created_at' => $review->created_at,
            'formatted_date' => $review->created_at->diffForHumans(),
        ];
    }

    /**
     * Calculate rating distribution
     */
    public function calculateRatingDistribution($reviews)
    {
        $ratingCounts = array_fill(1, 5, 0);

        foreach ($reviews as $review) {
            $roundedRate = max(1, min(5, round($review->rate)));
            $ratingCounts[$roundedRate]++;
        }

        $totalReviews = $reviews->count();
        $averageRatings = [];

        for ($i = 1; $i <= 5; $i++) {
            $averageRatings[$i] = [
                'rate' => $i,
                'count' => $ratingCounts[$i],
                'fraction' => number_format($totalReviews > 0 ? $ratingCounts[$i] / $totalReviews : 0, 1),
                'percentage' => $totalReviews > 0 ? round(($ratingCounts[$i] / $totalReviews) * 100, 1) : 0,
            ];
        }

        return $averageRatings;
    }

    /**
     * Get empty rating distribution
     */
    private function getEmptyRatingDistribution()
    {
        $distribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $distribution[$i] = [
                'rate' => $i,
                'count' => 0,
                'fraction' => '0.0',
                'percentage' => 0,
            ];
        }
        return $distribution;
    }

    /**
     * Calculate profile statistics
     */
    public function calculateProfileStatistics($doctorProfile)
    {
        $appointments = $doctorProfile->appointments;
        $reviews = $doctorProfile->reviews;
        $services = $doctorProfile->services;

        $totalAppointments = $appointments->count();
        $completedAppointments = $appointments->where('status', 'completed')->count();
        $pendingAppointments = $appointments->where('status', 'pending')->count();

        $completionRate = $totalAppointments > 0 ?
            round(($completedAppointments / $totalAppointments) * 100, 1) : 0;

        $totalRevenue = $appointments->where('status', 'completed')
            ->sum(function ($appointment) {
                return $appointment->service ? $appointment->service->price : 0;
            });

        return [
            'total_appointments' => $totalAppointments,
            'completed_appointments' => $completedAppointments,
            'pending_appointments' => $pendingAppointments,
            'completion_rate' => $completionRate,
            'total_reviews' => $reviews->count(),
            'average_rating' => $reviews->count() > 0 ? round($reviews->avg('rate'), 1) : 0,
            'total_services' => $services->count(),
            'active_services' => $services->where('is_active', 1)->count(),
            'total_revenue' => $totalRevenue,
            'min_service_price' => $services->isNotEmpty() ? $services->min('price') : 0,
            'max_service_price' => $services->isNotEmpty() ? $services->max('price') : 0,
        ];
    }

    /**
     * Get empty statistics
     */
    private function getEmptyStatistics()
    {
        return [
            'total_appointments' => 0,
            'completed_appointments' => 0,
            'pending_appointments' => 0,
            'completion_rate' => 0,
            'total_reviews' => 0,
            'average_rating' => 0,
            'total_services' => 0,
            'active_services' => 0,
            'total_revenue' => 0,
            'min_service_price' => 0,
            'max_service_price' => 0,
        ];
    }

    /**
     * Get patient profile data
     */
    public function getPatientProfileData($user, $cacheKey = null)
    {
        if ($cacheKey) {
            return Cache::remember($cacheKey, 600, function () use ($user) {
                return $this->fetchPatientProfileData($user);
            });
        }

        return $this->fetchPatientProfileData($user);
    }

    /**
     * Fetch patient profile data from database
     */
    private function fetchPatientProfileData($user)
    {
        $user->load([
            'patientProfile.insurance',
            'languages.language',
            'favoriteDoctors.doctorProfile.user'
        ]);

        $patientProfile = $user->patientProfile;

        if (!$patientProfile) {
            return [
                'error' => 'Patient profile not found',
                'profile' => null,
                'languages' => [],
                'statistics' => [],
            ];
        }

        $languages = $this->formatLanguages($user->languages);
        $statistics = $this->calculatePatientStatistics($user);

        return [
            'profile' => $patientProfile,
            'languages' => $languages,
            'statistics' => $statistics,
        ];
    }
    /**
     * Calculate patient statistics
     */
    public function calculatePatientStatistics($user)
    {
        $appointments = $user->patientProfile->appointments ?? collect();
        $favoriteDoctors = $user->favoriteDoctors;

        return [
            'total_appointments' => $appointments->count(),
            'completed_appointments' => $appointments->where('status', 'completed')->count(),
            'upcoming_appointments' => $appointments->whereIn('status', ['pending', 'upcoming'])->count(),
            'favorite_doctors_count' => $favoriteDoctors->count(),
            'total_spent' => $appointments->where('status', 'completed')
                ->sum(fn($appointment) => $appointment->bill ? $appointment->bill->total_amount : 0),
        ];
    }

    /**
     * Clear profile cache
     */
    public function clearProfileCache($userId)
    {
        $cacheKeys = [
            "doctor_profile_{$userId}",
            "patient_profile_{$userId}",
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }
    }

    /**
     * Update doctor profile
     */
    public function updateDoctorProfile($user, $validatedData)
    {
        try {
            DB::beginTransaction();

            // Update user information
            $user->update([
                'name' => $validatedData['name'],
                'gender' => $validatedData['gender'],
                'country_code' => $validatedData['country_code'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'latitude' => $validatedData['latitude'] ?? null,
                'longitude' => $validatedData['longitude'] ?? null,
                'address' => $validatedData['address'] ?? null,
                'city' => $validatedData['city'] ?? null,
                'state' => $validatedData['state'] ?? null,
                'country' => $validatedData['country'] ?? null,
                'zip_code' => $validatedData['zip_code'] ?? null,
            ]);

            // Handle avatar upload
            if (isset($validatedData['avatar']) && $validatedData['useDefaultAvatar'] == "0") {
                $avatarPath = $this->handleAvatarUpload($validatedData['avatar'], $user->avatar);
                $user->update(['avatar' => $avatarPath]);
            } elseif ($validatedData['useDefaultAvatar'] == "1") {
                $this->removeOldAvatar($user->avatar);
                $user->update(['avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name)]);
            }

            $doctorProfile = $user->doctorProfile;

            $medicalCategoryId = MedicalCategory::where('name', $validatedData['medical_category_name'])->value('id');

            $doctorProfile->update([
                'professional_number' => $validatedData['professional_number'],
                'introduce' => $validatedData['introduce'],
                'medical_category_id' => $medicalCategoryId,
                'office_address' => $validatedData['office_address'],
                'company_name' => $validatedData['company_name'],
            ]);

            // Update languages
            $this->updateUserLanguages($user, $validatedData['languages']);

            DB::commit();
            return [
                'profile' => $user->load('doctorProfile.medicalCategory', 'languages.language'),
                'message' => 'Doctor profile updated successfully'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'error' => 'Failed to update doctor profile: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Update patient profile
     */
    public function updatePatientProfile($user, $validatedData)
    {
        try {
            DB::beginTransaction();

            // Update user information
            $user->update([
                'name' => $validatedData['name'],
                'gender' => $validatedData['gender'] ?? null,
                'country_code' => $validatedData['country_code'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'latitude' => $validatedData['latitude'] ?? null,
                'longitude' => $validatedData['longitude'] ?? null,
                'address' => $validatedData['address'] ?? null,
                'city' => $validatedData['city'] ?? null,
                'state' => $validatedData['state'] ?? null,
                'country' => $validatedData['country'] ?? null,
                'zip_code' => $validatedData['zip_code'] ?? null,
            ]);

            // Handle avatar upload
            if (isset($validatedData['avatar']) && $validatedData['useDefaultAvatar'] == '0') {
                $avatarPath = $this->handleAvatarUpload($validatedData['avatar'], $user->avatar);
                $user->update(['avatar' => $avatarPath]);
            } elseif ($validatedData['useDefaultAvatar'] == '1') {
                $this->removeOldAvatar($user->avatar);
                $user->update(['avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name)]);
            }

            $patientProfile = $user->patientProfile;

            $patientProfile->update([
                'birth_date' => $validatedData['birth_date'] ?? null,
                'age' => $validatedData['age'] ?? null,
                'height' => $validatedData['height'] ?? null,
                'weight' => $validatedData['weight'] ?? null,
                'blood_group' => $validatedData['blood_group'] ?? null,
                'medical_history' => $validatedData['medical_history'] ?? null,
            ]);

            // Update languages
            $this->updateUserLanguages($user, $validatedData['languages']);

            DB::commit();
            return [
                'profile' => $user->load('patientProfile.insurance', 'languages.language'),
                'message' => 'Patient profile updated successfully'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'error' => 'Failed to update patient profile: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Handle avatar upload
     */
    private function handleAvatarUpload($avatarFile, $currentAvatar = null)
    {
        // Remove old avatar if exists
        $this->removeOldAvatar($currentAvatar);

        // Generate unique filename
        $imageName = time() . '_' . uniqid() . '.' . $avatarFile->getClientOriginalExtension();

        // Move file to upload directory
        $avatarFile->move(storage_path('app/public/upload/avatar'), $imageName);

        return "/upload/avatar/{$imageName}";
    }

    /**
     * Remove old avatar file
     */
    private function removeOldAvatar($avatarPath)
    {
        if ($avatarPath->startsWith('https://') || str_starts_with($avatarPath, 'storage/upload/avatar/default.png')) {
            return;
        }

        if ($avatarPath) {
            $fullPath = storage_path($avatarPath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }

    /**
     * Update user languages
     */
    private function updateUserLanguages($user, $languagesJson)
    {
        // Delete existing languages
        $user->languages()->delete();

        // Parse and create new languages
        $languageList = json_decode($languagesJson, true);

        foreach ($languageList as $language) {
            if (!empty($language)) {
                $languageId = Language::where(['name' => $language['name']])->first()->id;

                $user->languages()->create([
                    'language_id' => $languageId,
                ]);
            }
        }
    }
}
