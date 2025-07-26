<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\WorkScheduleController;

Route::get('/work-schedules', [WorkScheduleController::class, 'getWorkSchedule']);
Route::post('/work-schedules/add', [WorkScheduleController::class, 'addWorkSchedule']);
Route::post('/work-schedules/delete', [WorkScheduleController::class, 'deleteWorkSchedule']);
