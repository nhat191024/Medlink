<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\LocalizationMiddleware;

// Define API routes that require authentication
// Route::middleware(['auth:sanctum', LocalizationMiddleware::class])->group(function () {});

// Define API routes that do not require authentication
Route::middleware([LocalizationMiddleware::class])->group(function () {
    require __DIR__ . '/api/auth.php';
});
