<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/splash', [AuthController::class, 'showSplashForm'])->name('splash');
});
