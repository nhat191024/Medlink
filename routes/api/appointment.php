<?php

use App\Http\Controllers\Api\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/appointments/doctor', [AppointmentController::class, 'doctorAppointments']);
Route::get('/appointments/patient', [AppointmentController::class, 'patientAppointments']);
Route::post('/appointments/status', [AppointmentController::class, 'updateAppointmentStatus']);
