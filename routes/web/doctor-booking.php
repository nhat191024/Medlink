<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::prefix('appointment')->name('appointment.')->group(function () {
    Route::get('/', [BookingController::class, 'showDoctorBookingList'])->name('index');
    Route::get('/info/{doctor_profile_id}', [BookingController::class, 'showDoctorInfo'])->name('info');
    Route::get('/step/1/{doctor_profile_id}', [BookingController::class, 'showStepOne'])->name('step.one');
    Route::post('/step/1', [BookingController::class, 'storeStepOne'])->name('step.one.store');

    Route::get('/step/2', [BookingController::class, 'showStepTwo'])->name('step.two');
    Route::post('/step/2', [BookingController::class, 'storeStepTwo'])->name('step.two.store');

    Route::get('/step/3', [BookingController::class, 'showStepThree'])->name('step.three');
    Route::post('/step/3', [BookingController::class, 'storeStepThree'])->name('step.three.store');

    Route::get('/payment-result', [BookingController::class, 'paymentResultCallback'])->name('process-payment');
    Route::get('/success', [BookingController::class, 'showSuccess'])->name('success');
    Route::get('/failed', [BookingController::class, 'showFailed'])->name('failed');

});
