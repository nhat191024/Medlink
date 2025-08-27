<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientProfileController;

Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [PatientProfileController::class, 'show'])->name('index');
    Route::get('/edit', [PatientProfileController::class, 'edit'])->name('edit');
    Route::put('/', [PatientProfileController::class, 'update'])->name('update');
    Route::get('/appointment-history', [PatientProfileController::class, 'appointmentHistory'])->name('appointment-history');
});

// Appointment review and support routes
Route::post('/appointment/{appointment}/review', [PatientProfileController::class, 'submitReview'])->name('appointment.review');
Route::post('/appointment/{appointment}/support', [PatientProfileController::class, 'submitSupport'])->name('appointment.support');
