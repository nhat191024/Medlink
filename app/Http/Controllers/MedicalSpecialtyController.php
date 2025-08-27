<?php

namespace App\Http\Controllers;

use App\Models\MedicalCategory;
use App\Models\DoctorProfile;
use App\Models\Review;
use App\Models\WorkSchedule;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

use App\Helper\CacheKey;

class MedicalSpecialtyController extends Controller
{
    private $cacheKey;

    public function __construct()
    {
        $this->cacheKey = new CacheKey();
    }

    /**
     * Display all medical specialties
     */
    public function index()
    {
        // Get all medical categories with doctor counts
        $cacheKey = $this->cacheKey::MEDICAL_CATEGORIES;
        $specialties = Cache::remember($cacheKey, 300, function () {
            return MedicalCategory::withCount([
                'doctorProfiles as doctors_count' => function ($query) {
                    $query->whereHas('user', function ($userQuery) {
                        $userQuery->where('status', 'active');
                    });
                }
            ])
                ->orderBy('name')
                ->get()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'doctors_count' => $category->doctors_count,
                        'slug' => Str::slug($category->name),
                        'icon' => $this->getSpecialtyIcon($category->name),
                    ];
                });
        });

        return view('medical-specialties.index', compact('specialties'));
    }

    /**
     * Display doctors in a specific medical specialty
     */
    public function show(string $slug)
    {
        $medicalCategory =  MedicalCategory::where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();

        $cacheKey = $this->cacheKey::DOCTOR_IN_CATEGORY . $medicalCategory->id;

        $doctors = Cache::remember($cacheKey, 300, function () use ($medicalCategory) {
            return DoctorProfile::with(['user', 'medicalCategory', 'services'])
                ->where('medical_category_id', $medicalCategory->id)
                ->whereHas('user', function ($query) {
                    $query->where('status', 'active');
                })
                ->get()
                ->map(function ($doctor) {
                    $reviews = Review::where('doctor_profile_id', $doctor->id)->get();
                    $average_rating = $reviews->avg('rate') ?? 0;
                    $total_reviews = $reviews->count();

                    $is_available = WorkSchedule::isAvailable($doctor->id) == 1;

                    $service_price = $doctor->services->isNotEmpty() ? $doctor->services->min('price') : 0;

                    return array_merge(
                        $doctor->toArray(),
                        [
                            'average_rating' => $average_rating,
                            'total_reviews' => $total_reviews,
                            'is_available' => $is_available,
                            'service_price' => $service_price,
                        ]
                    );
                })
                ->sortByDesc(function ($doctor) {
                    return $doctor['average_rating'] * 1000 + ($doctor['is_available'] ? 1 : 0);
                })
                ->values();
        });

        $seccondCacheKey = $this->cacheKey::RELATED_SPECIALTIES . $medicalCategory->id;

        $relatedSpecialties = Cache::remember($seccondCacheKey, 300, function () use ($medicalCategory) {
            return MedicalCategory::where('id', '!=', $medicalCategory->id)
                ->withCount(['doctorProfiles as doctors_count' => function ($query) {
                    $query->whereHas('user', function ($userQuery) {
                        $userQuery->where('status', 'active');
                    });
                }])
                ->having('doctors_count', '>', 0)
                ->inRandomOrder()
                ->limit(6)
                ->get()
                ->map(function ($specialty) {
                    $specialty->icon = $this->getSpecialtyIcon($specialty->name);
                    $specialty->slug = Str::slug($specialty->name);
                    return $specialty;
                });
        });

        // dd($doctors);

        return view('medical-specialties.show', compact(
            'medicalCategory',
            'doctors',
            'relatedSpecialties'
        ));
    }

    /**
     * Get icon for specialty based on name
     */
    private function getSpecialtyIcon($name)
    {
        $icons = [
            'Tim mạch' => 'healthicons-f-heart-cardiogram',
            'Nhi' => 'bi-emoji-smile',
            'Da liễu' => 'bi-droplet',
            'Mắt' => 'bi-eye',
            'Tai mũi họng' => 'bi-ear',
            'Thần kinh' => 'bi-lightning',
            'Xương khớp' => 'bi-person-walking',
            'Nội khoa' => 'bi-hospital',
            'Ngoại khoa' => 'bi-scissors',
            'Phụ sản' => 'bi-gender-female',
            'Tiêu hóa' => 'healthicons-f-stomach',
            'Hô hấp' => 'bi-lungs',
        ];

        foreach ($icons as $key => $icon) {
            if (str_contains($name, $key)) {
                return $icon;
            }
        }

        return 'bi-plus-circle'; // Default medical icon
    }
}
