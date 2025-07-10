<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserService
{
    /**
     * Format doctor name with title based on identity.
     *
     * @param string|null $fullName
     * @param int $identity
     * @return string
     */
    public function formatDoctorName(?string $fullName, string $identity): string
    {
        if (!$fullName) {
            return 'Not provided';
        }

        return $identity === 'doctor' ? "Dr. {$fullName}" : $fullName;
    }

    /**
     * Get reviewer avatars from doctor reviews.
     *
     * @param \Illuminate\Database\Eloquent\Collection|null $reviews
     * @return array
     */
    public function getReviewerAvatars($reviews): array
    {
        if (!$reviews) {
            return [];
        }

        return $reviews
            ->sortByDesc('created_at')
            ->take(4)
            ->map(fn($review) => $review->patient?->avatar ? asset($review->patient->avatar) : null)
            ->filter() // Remove null values
            ->values()
            ->toArray();
    }

    /**
     * Clear cache for user summary data - call from other controllers when profile updated
     *
     * @param int|null $userId
     * @return void
     */
    public static function clearUserSummaryCache($userId = null)
    {
        $userId ??= Auth::id();

        if ($userId) {
            Cache::forget("patient_summary_{$userId}");
            Cache::forget("doctor_profile_{$userId}");
            Cache::forget("doctor_appointments_{$userId}");
            Cache::forget("doctor_notifications_{$userId}");
        }
    }

    /**
     * Clear only appointment cache when appointment status changes
     *
     * @param int|null $userId
     * @return void
     */
    public static function clearAppointmentCache($userId = null)
    {
        $userId ??= Auth::id();

        if ($userId) {
            Cache::forget("doctor_appointments_{$userId}");
        }
    }

    /**
     * Clear only notification cache when notification status changes
     *
     * @param int|null $userId
     * @return void
     */
    public static function clearNotificationCache($userId = null)
    {
        $userId ??= Auth::id();

        if ($userId) {
            Cache::forget("doctor_notifications_{$userId}");
        }
    }
}
