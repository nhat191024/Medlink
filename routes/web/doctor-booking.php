<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::prefix('appointment')->name('appointment.')->group(function () {
    Route::get('/', [BookingController::class, 'showDoctorBookingList'])->name('index');
    Route::get('/book/{user_id}', [BookingController::class, 'showAppointment'])->name('step.1');
    Route::post('/stored/step/1', [BookingController::class, 'storeAppointment'])->name('step.1.store');
    Route::post('/stored/step/2', [BookingController::class, 'storeDetailAppointment'])->name('step.2.store');
    Route::post('/stored/step/3', [BookingController::class, 'storePaymentAppointment'])->name('step.3.store');

    // Route::get('/step/2', [BookingController::class, 'showDetailAppointmentForm'])->name('step.2');
    // Route::get('/step/3', [BookingController::class, 'showConfirmPaymentAppointment'])->name('step.3');
});
