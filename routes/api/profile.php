<?php

use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/profile/doctor', [ProfileController::class, 'doctorProfile']); //* Tested
Route::get('/profile/patient', [ProfileController::class, 'patientProfile']); //! not tested
Route::get('/profile/statistics', [ProfileController::class, 'profileStatistics']); //! not tested
Route::post('/profile/doctor/edit', [ProfileController::class, 'doctorEditProfile']); //! not tested
Route::post('/profile/patient/edit', [ProfileController::class, 'patientEditProfile']); //! not tested
