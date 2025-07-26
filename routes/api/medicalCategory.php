<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MedicalCategoryController;

Route::get('/medical-categories', [MedicalCategoryController::class, 'index']);
