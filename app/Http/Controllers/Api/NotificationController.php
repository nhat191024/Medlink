<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Http\Services\NotificationService;

use Symfony\Component\HttpFoundation\Response;

use App\Helper\CacheKey;

class NotificationController extends Controller
{
    private $notificationService;
    private $cacheKey;

    public function __construct()
    {
        $this->notificationService = app(NotificationService::class);
        $this->cacheKey = new CacheKey();
    }

    /**
     * Display a listing of the notifications.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userId = Auth::id();
        $cacheKey = $this->cacheKey::USER_NOTIFICATIONS . $userId;

        // Cache notifications for 5 minutes
        $mappedNotifications = Cache::remember($cacheKey, 300, function () use ($userId) {
            $notifications = Auth::user()->notification()
                ->with(['appointment.service', 'appointment.patient'])
                ->orderBy('created_at', 'desc')
                ->get();

            return $this->notificationService->mapNotifications($notifications);
        });

        return response()->json($mappedNotifications);
    }

    /**
     * Mark notification as read and clear cache
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead($id)
    {
        $userId = Auth::id();
        $notification = Notification::where('id', $id)
            ->whereHas('appointment.doctor.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            })
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], Response::HTTP_NOT_FOUND);
        }

        $notification->update(['status' => 'read']);

        // Clear cache when notification is updated
        $cacheKey = $this->cacheKey::USER_NOTIFICATIONS . $userId;
        Cache::forget($cacheKey);

        return response()->json(['message' => 'Notification marked as read']);
    }

    /**
     * Mark all notifications as read and clear cache
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAllAsRead()
    {
        $userId = Auth::id();

        Notification::whereHas('appointment.doctor.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->update(['status' => 'read']);

        // Clear cache when notifications are updated
        $cacheKeys = [
            $this->cacheKey::USER_NOTIFICATIONS . $userId,
            $this->cacheKey::UNREAD_NOTIFICATIONS_COUNT . $userId
        ];
        foreach ($cacheKeys as $cacheKey) {
            Cache::forget($cacheKey);
        }

        return response()->json(['message' => 'All notifications marked as read']);
    }

    /**
     * Get unread notifications count with cache
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnreadCount()
    {
        $userId = Auth::id();
        $cacheKey = $this->cacheKey::UNREAD_NOTIFICATIONS_COUNT . $userId;

        $count = Cache::remember($cacheKey, 300, function () use ($userId) {
            return Notification::whereHas('appointment.doctor.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            })->where('status', 'unread')->count();
        });

        return response()->json(['unread_count' => $count]);
    }
}
