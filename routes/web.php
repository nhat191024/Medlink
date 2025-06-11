<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('layouts.app');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/splash', [AuthController::class, 'showSplashForm'])->name('splash');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
