<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::prefix('register')->middleware('guest')->name('register.')->group(fn() => [

    Route::get('/', fn() => view('auth.register'))->name('phone'),
    Route::get('/otp', fn() => view('auth.otp'))->name('otp'),
    Route::get('/create-account', fn() => view('auth.create-account'))->name('create-account'),

    Route::post('/phone/submit', [AuthController::class, 'phoneRegisterSubmit'])->name('phone.submit'),
    Route::post('/otp/submit',[AuthController::class, 'otpRegisterSubmit'])->name('otp.submit'),
    Route::post('/create-account/submit', [AuthController::class, 'createAccountRegisterSubmit'])->name('create-account.submit'),



    Route::get('/profile', fn() => view('auth.profile'))->name('profile'),
    Route::get('/avatar', fn() => view('auth.avatar'))->name('avatar'),
    Route::get('/progress', fn() => view('auth.progress'))->name('progress'),
    Route::get('/complete', fn() => view('auth.complete'))->name('complete'),

    Route::post('/profile/submit', [AuthController::class, 'profileRegisterSubmit'])->name('profile.submit'),
    Route::post('/avatar/submit', [AuthController::class, 'avatarRegisterSubmit'])->name('avatar.submit'),

]);
