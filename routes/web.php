<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/splash', [AuthController::class, 'showSplashForm'])->name('splash');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});
