<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Auth routes
Route::middleware('guest')->group(function () {
    route::get('/', function () {
        return view('layouts.app');
    });

    Route::get('/splash', [AuthController::class, 'showSplashForm'])->name('splash');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    require __DIR__ . '/web/register.php';

    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('forgot-password.send-otp');
    Route::get('/forgot-password/otp', function () {
        return view('auth.forgot-password-otp');
    })->name('forgot-password.otp.form');
    Route::post('/forgot-password/otp', [AuthController::class, 'verifyOtp'])->name('forgot-password.verify-otp');
    Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('reset-password.form');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.post');
});
