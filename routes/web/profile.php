<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientProfileController;

Route::prefix('forgot-password')->name('profile.')->group(fn() => [
    Route::get('/profile', [PatientProfileController::class, 'show'])->name('index'),
    Route::get('/profile/edit', [PatientProfileController::class, 'edit'])->name('edit'),
    Route::put('/profile', [PatientProfileController::class, 'update'])->name('update')
]);
