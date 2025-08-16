<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\DoctorProfile;
use App\Models\MedicalCategory;
use App\Models\Review;
use App\Models\Appointment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use App\Http\Services\ReviewService;
use App\Helper\CacheKey;

class HomeController extends Controller
{
    private $reviewService;
    private $cacheKey;

    // Cache times in seconds
    private const int CACHE_TIME_SHORT = 300;
    private const int CACHE_TIME_MEDIUM = 1800;
    private const int CACHE_TIME_LONG = 3600;

    public function __construct()
    {
        $this->reviewService = app(ReviewService::class);
        $this->cacheKey = new CacheKey();
    }

    public function index()
    {
        $baseCacheKey = $this->cacheKey::HOME;

        $data = [
            'categories' => $this->getCategories($baseCacheKey),
            'hospitals' => $this->getHospitals($baseCacheKey),
            'doctors' => $this->getDoctors($baseCacheKey),
            'statistics' => $this->getStatistics($baseCacheKey),
        ];

        $data['favoriteDoctors'] = $this->getFavoriteDoctors($baseCacheKey, $data['doctors']);
        $data['reviews'] = $this->getReviews($baseCacheKey);

        return view('home', $data);
    }

    private function getCategories(string $baseCacheKey)
    {
        return Cache::remember("{$baseCacheKey}_categories", self::CACHE_TIME_LONG, function () {
            return MedicalCategory::select(['id', 'name'])
                ->orderBy('name')
                ->get();
        });
    }

    private function getHospitals(string $baseCacheKey)
    {
        return Cache::remember("{$baseCacheKey}_hospitals", self::CACHE_TIME_MEDIUM, function () {
            return Hospital::whereNull('deleted_at')
                ->where(function ($query) {
                    $query->whereNull('contract_end_date')
                        ->orWhere('contract_end_date', '>', now());
                })
                ->orderBy('name')
                ->get();
        });
    }

    private function getDoctors(string $baseCacheKey)
    {
        return Cache::remember("{$baseCacheKey}_doctors", self::CACHE_TIME_SHORT, function () {
            return DoctorProfile::select([
                'id',
                'user_id',
                'medical_category_id',
                'company_name',
                'introduce',
                'created_at'
            ])
                ->with([
                    'user:id,name,avatar,city,country',
                    'medicalCategory:id,name',
                    'reviews:id,doctor_profile_id,rate',
                    'services:id,doctor_profile_id,price'
                ])
                ->withCount('reviews')
                ->withAvg('reviews', 'rate')
                ->limit(10)
                ->get();
        });
    }

    private function getFavoriteDoctors(string $baseCacheKey, $doctors)
    {
        return Cache::remember("{$baseCacheKey}_favorite_doctors", self::CACHE_TIME_SHORT, function () use ($doctors) {
            return $this->reviewService->getFavoriteDoctors($doctors);
        });
    }

    private function getReviews(string $baseCacheKey)
    {
        return Cache::remember("{$baseCacheKey}_reviews_showcase", self::CACHE_TIME_SHORT, function () {
            return $this->reviewService->getReviewsShowCase();
        });
    }

    private function getStatistics(string $baseCacheKey)
    {
        return Cache::remember("{$baseCacheKey}_statistics", self::CACHE_TIME_MEDIUM, function () {
            $stats = DB::select("
                SELECT
                    (SELECT COUNT(*) FROM doctor_profiles) as total_doctors,
                    (SELECT COUNT(*) FROM hospitals WHERE deleted_at IS NULL) as total_hospitals,
                    (SELECT COUNT(*) FROM medical_categories WHERE deleted_at IS NULL) as total_categories,
                    (SELECT COUNT(*) FROM reviews) as total_reviews,
                    (SELECT COUNT(*) FROM appointments WHERE deleted_at IS NULL) as total_appointments,
                    (SELECT COUNT(*) FROM reviews WHERE rate >= 4) as satisfied_patients,
                    (SELECT COALESCE(AVG(rate), 0) FROM reviews) as average_rating,
                    (SELECT COUNT(*) FROM hospitals
                    WHERE deleted_at IS NULL
                    AND (contract_end_date IS NULL OR contract_end_date > NOW())
                    ) as active_hospitals
            ");

            $result = $stats[0] ?? null;

            return [
                'total_doctors' => (int) $result->total_doctors,
                'total_hospitals' => (int) $result->total_hospitals,
                'total_categories' => (int) $result->total_categories,
                'total_reviews' => (int) $result->total_reviews,
                'total_appointments' => (int) $result->total_appointments,
                'satisfied_patients' => (int) $result->satisfied_patients,
                'average_rating' => round((float) $result->average_rating, 1),
                'active_hospitals' => (int) $result->active_hospitals,
            ];
        });
    }
}
