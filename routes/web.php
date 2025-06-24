<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Auth routes
Route::middleware('guest')->group(function () {
    route::get('/', function () {
        return view('layouts.app');
    });

    Route::get('/splash', [AuthController::class, 'showSplashForm'])->name('splash');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
});
