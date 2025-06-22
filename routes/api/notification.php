<?php

use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\Facades\Route;

route::get('/notifications', [NotificationController::class, 'index']);
route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead']);
route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);
route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount']);
