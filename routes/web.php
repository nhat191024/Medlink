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
    Route::get('/register', function () {
    return view('auth.register');
})->name('register');
    Route::get('/otp', function () {
    return view('auth.otp');
})->name('otp.form');
});
