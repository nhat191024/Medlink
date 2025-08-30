<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MedicalSpecialtyController;

use App\Helper\MailHelper;

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/splash', [AuthController::class, 'showSplashForm'])->name('splash');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/database-erd', fn() => view('database.erd'));

    require __DIR__ . '/web/register.php';
    require __DIR__ . '/web/forgot-password.php';
});

Route::middleware('auth')->group(function () {
    require __DIR__ . '/web/doctor-booking.php';
    require __DIR__ . '/web/profile.php';
    require __DIR__ . '/web/medical-specialties.php';
    require __DIR__ . '/web/notifications.php';

    // Test routes for development
    if (app()->environment(['local', 'staging'])) {
        require __DIR__ . '/web/test.php';
    }
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/info/{doctor_profile_id}', [BookingController::class, 'showDoctorInfo'])->name('appointment.info');
