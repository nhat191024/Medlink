<?php

use App\Http\Controllers\Api\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/patient-summary', [DashboardController::class, 'patientSummary']);
Route::get('/doctor-summary', [DashboardController::class, 'doctorSummary']);

//refresh cache call for developer
Route::get('/refresh-cache', [DashboardController::class, 'refreshCache']);
