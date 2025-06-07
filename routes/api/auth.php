<?php

use App\Http\Controllers\API\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);
Route::post('/check-email', [LoginController::class, 'checkEmail']);
Route::post('/password-reset-request', [LoginController::class, 'passwordResetRequest']);
