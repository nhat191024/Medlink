<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

use App\Http\Middleware\LocalizationMiddleware;
use App\Http\Middleware\LogRouteAccess;

// Define API routes that require authentication
Route::middleware(['auth:sanctum', LocalizationMiddleware::class, LogRouteAccess::class])->group(function () {

    //* Authentication routes
    Route::get('token-check', [AuthController::class, 'tokenCheck']);
    Route::post('/password-reset-request', [AuthController::class, 'passwordResetRequest']);
    Route::get('/logout', [AuthController::class, 'logout']);

    require __DIR__ . '/api/dashboard.php';
    require __DIR__ . '/api/notification.php';
    require __DIR__ . '/api/search.php';
    require __DIR__ . '/api/appointment.php';
    require __DIR__ . '/api/profile.php';
    require __DIR__ . '/api/farvorite.php';
    require __DIR__ . '/api/payment.php';
    require __DIR__ . '/api/wallet.php';
    require __DIR__ . '/api/setting.php';
    require __DIR__ . '/api/service.php';
    require __DIR__ . '/api/workSchedule.php';
});

// Define API routes that do not require authentication
Route::middleware([LocalizationMiddleware::class, LogRouteAccess::class])->group(function () {
    require __DIR__ . '/api/auth.php';
});
