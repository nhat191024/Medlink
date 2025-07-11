<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/splash', [AuthController::class, 'showSplashForm'])->name('splash');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    require __DIR__ . '/web/register.php';
    require __DIR__ . '/web/forgot-password.php';
});

Route::middleware('auth')->group(function () {
    require __DIR__ . '/web/doctor-booking.php';
});

route::get('/', function () {
    return view('layouts.app');
});

Route::get('/home/doctor-detail', function () {
    return view('home.doctor-detail');
});

Route::get('/booking', function () {
    return view('appointment.booking');
});
