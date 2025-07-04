<?php

use App\Http\Controllers\Api\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/appointments/doctor', [AppointmentController::class, 'doctorAppointments']); //* Tested
Route::get('/appointments/patient', [AppointmentController::class, 'patientAppointments']); //! not tested
Route::post('/appointments/status', [AppointmentController::class, 'updateAppointmentStatus']); //! not tested
Route::post('/appointments/book', [AppointmentController::class, 'bookAppointment']); //* Tested
Route::post('/appointments/{id}/feedback', [AppointmentController::class, 'appointmentFeedback']); //! not tested
