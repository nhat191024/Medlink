<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientProfileController;

Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [PatientProfileController::class, 'show'])->name('index');
    Route::get('/edit', [PatientProfileController::class, 'edit'])->name('edit');
    Route::put('/', [PatientProfileController::class, 'update'])->name('update');
    Route::get('/appointment-history', [PatientProfileController::class, 'appointmentHistory'])->name('appointment-history');
});
