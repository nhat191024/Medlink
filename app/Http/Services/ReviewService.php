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
        $sortedReviews->load('patient');
        return $sortedReviews->take(2)->map(fn($review) => [
            'id' => $review->id,
            'rate' => $review->rate,
            'review' => $review->review,
            'name' => $review->patient->name,
            'avatar' => $review->patient->avatar ? asset($review->patient->avatar) : '',
            'created_at' => $review->created_at,
        ]);
    }
}
