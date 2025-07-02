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
});
