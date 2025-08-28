<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientProfileController;

Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [PatientProfileController::class, 'show'])->name('index');
    Route::get('/edit', [PatientProfileController::class, 'edit'])->name('edit');
    Route::put('/', [PatientProfileController::class, 'update'])->name('update');
    Route::get('/appointment-history', [PatientProfileController::class, 'appointmentHistory'])->name('appointment-history');
    Route::get('/support-requests', [PatientProfileController::class, 'supportRequests'])->name('support-requests');
});

// Appointment review, support and cancel routes
Route::post('/appointment/{appointment}/review', [PatientProfileController::class, 'submitReview'])->name('appointment.review');
Route::post('/appointment/{appointment}/support', [PatientProfileController::class, 'submitSupport'])->name('appointment.support');
Route::post('/appointment/{appointment}/cancel', [PatientProfileController::class, 'cancelAppointment'])->name('appointment.cancel');
