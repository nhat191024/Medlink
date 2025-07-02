<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::prefix('register')->middleware('guest')->name(value: 'register.')->group(fn() => [

    Route::get('/', fn() => view('auth.register'))->name('form'),
    Route::get('/otp', fn() => view('auth.otp'))->name('otp'),
    Route::get('/create-account', fn() => view('auth.create-account'))->name('create-account'),

    Route::get('/profile', fn() => view('auth.profile'))->name('profile'),
    Route::get('/progress', fn() => view('auth.register-progress'))->name('progress'),
    Route::get('/complete', fn() => view('auth.register-complete'))->name('complete'),

    Route::get('/flow/{step}', fn($step) => view('auth.register-flow', ['step' => $step]))->name('flow'),
]);
