<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/check-email', [AuthController::class, 'checkEmail']);
Route::post('/mail-check', [AuthController::class, 'mailCheck']);
