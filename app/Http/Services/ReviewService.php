<?php

namespace App\Http\Services;

class ReviewService
{
    public function getTestimonials($reviews)
    {
        $testimonialsTitle = [
            'Bad',
            'Not happy',
            'Average',
            'Good',
            'Excellent',
        ];

        $totalReviews = count($reviews);
        $ratingCounts = array_fill(1, 5, 0);

        foreach ($reviews as $review) {
            $roundedRate = round($review['rate']);
            if ($roundedRate <= 1) $roundedRate = 1;
            if ($roundedRate >= 5) $roundedRate = 5;
            $ratingCounts[$roundedRate]++;
        }

        $testimonials = [];
        for ($i = 1; $i <= 5; $i++) {
            $testimonials[] = [
                'star' => $i,
                'title' => $testimonialsTitle[$i - 1],
                'total' => $ratingCounts[$i],
                'fraction' => number_format($totalReviews > 0 ? $ratingCounts[$i] / $totalReviews : 0, 1)
            ];
        }

        return $testimonials;
    }

    public function getTopReviews($reviews)
    {
        $sortedReviews = $reviews->sortByDesc(function ($review) {
            return [$review->rate, $review->created_at];
        })->values();
        $sortedReviews->load('patient.user');
        return $sortedReviews->take(2)->map(fn($review) => [
            'id' => $review->id,
            'rate' => $review->rate,
            'review' => $review->review,
            'name' => $review->patient->user->name,
            'avatar' => $review->patient->user->avatar ? asset($review->patient->user->avatar) : null,
            'created_at' => $review->created_at,
        ]);
    }

    public function getFavoriteDoctors($doctors)
    {
        $sortedDoctors = $doctors->sortByDesc(function ($doctor) {
            $averageRating = $doctor->reviews_avg_rate ?? 0;
            $reviewsCount = $doctor->reviews_count;

            return [$averageRating, $reviewsCount];
        })->values();

        $favoriteDoctors = $sortedDoctors->filter(fn($doctor) => $doctor->reviews_count > 0);

        return $favoriteDoctors->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->user->name,
                'avatar' => $doctor->user->avatar ? asset($doctor->user->avatar) : null,
                'medical_category' => $doctor->medicalCategory->name ?? null,
                'office_address' => $doctor->office_address,
                'company_name' => $doctor->company_name,
                'introduce' => $doctor->introduce,
                'average_rating' => round($doctor->reviews_avg_rate ?? 0, 1),
                'total_reviews' => $doctor->reviews_count,
                'created_at' => $doctor->created_at,
            ];
        });
    }
}
