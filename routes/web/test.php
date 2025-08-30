<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Auth;

// Test route để tạo notification mẫu
Route::get('/test/create-notification', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    // Tạo notification mẫu bằng Laravel Database Notifications
    $user->notify(new TestNotification([
        'title' => 'Bác sĩ không xác nhận hẹn',
        'body' => 'Bác sĩ không xác nhận hẹn khám của bạn vào lúc 2025-08-24 08:00 AM - 08:30 AM. Vui lòng thử lại sau.',
        'iconColor' => 'danger',
        'icon' => 'heroicon-o-x-circle',
        'color' => null,
        'duration' => 'persistent',
        'status' => 'danger',
        'view' => 'filament-notifications::notification',
        'viewData' => [],
        'format' => 'filament'
    ]));

    return response()->json(['message' => 'Test notification created successfully']);
})->name('test.create-notification');

Route::get('/test/notifications', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();
    $notifications = $user->notifications()->latest()->take(10)->get();

    return response()->json($notifications);
})->name('test.notifications');
