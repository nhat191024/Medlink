<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;

use App\Http\Middleware\LocalizationMiddleware;

// Define API routes that require authentication
Route::middleware(['auth:sanctum', LocalizationMiddleware::class])->group(function () {

    //* Authentication routes
    Route::post('/password-reset-request', [AuthController::class, 'passwordResetRequest']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

// Define API routes that do not require authentication
Route::middleware([LocalizationMiddleware::class])->group(function () {
    require __DIR__ . '/api/auth.php';
});
