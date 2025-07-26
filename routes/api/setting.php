<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserSettingController;

Route::get('/settings', [UserSettingController::class, 'getUserSetting']);
Route::post('/settings/update', [UserSettingController::class, 'updateUserSetting']);
