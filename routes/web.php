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

    require __DIR__ . '/web/register.php';
    require __DIR__ . '/web/forgot-password.php';
});

Route::middleware('auth')->group(function () {
    require __DIR__ . '/web/doctor-booking.php';
    require __DIR__ . '/web/profile.php';
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/info/{doctor_profile_id}', [BookingController::class, 'showDoctorInfo'])->name('appointment.info');

// Test route for success page
// Route::get('/test-success', function () {
//     session()->flash('serviceName', 'Khám tim mạch');
//     session()->flash('date', '25/12/2024');
//     session()->flash('time', '09:00 - 10:00');
//     return redirect()->route('appointment.success');
// })->name('test.success');
