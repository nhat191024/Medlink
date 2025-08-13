<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/splash', [AuthController::class, 'showSplashForm'])->name('splash');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/database-erd', fn() => view('database.erd'));
    Route::get('/info/{doctor_profile_id}', [BookingController::class, 'showDoctorInfo'])->name('appointment.info');

    require __DIR__ . '/web/register.php';
    require __DIR__ . '/web/forgot-password.php';
});

Route::middleware('auth')->group(function () {
    require __DIR__ . '/web/doctor-booking.php';

    Route::get('/profile', fn() => view('user.profile'))->name('profile');
});

route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home/doctor-detail', function () {
    return view('home.doctor-detail');
});

Route::get('/booking', function () {
    return view('appointment.booking');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
