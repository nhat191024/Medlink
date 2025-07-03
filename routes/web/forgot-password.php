<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('forgot-password')->middleware('guest')->name('forgot-password.')->group(fn() => [

    Route::get('/', [AuthController::class, 'showForgotPasswordForm'])->name('index'),
    Route::post('/', [AuthController::class, 'sendOtp'])->name('send-otp'),
    Route::get('/otp', fn() => view('auth.forgot-password-otp'))->name('otp'),
    Route::post('/otp', [AuthController::class, 'verifyOtp'])->name('verify-otp'),
    Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('reset-password'),
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password-post'),
]);
