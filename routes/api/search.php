<?php

use App\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/search/number-of-each-category', [SearchController::class, 'getNumberOfEachCategory']);
Route::get('/search/doctor', [SearchController::class, 'getDoctorList']);
