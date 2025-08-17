<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicalSpecialtyController;

Route::prefix('medical-specialties')->name('medical-specialties.')->group(fn() => [
    Route::get('/', [MedicalSpecialtyController::class, 'index'])->name('index'),
    Route::get('/{slug}', [MedicalSpecialtyController::class, 'show'])->name('show'),
]);
