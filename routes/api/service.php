<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ServiceController;

Route::get('/services', [ServiceController::class, 'getUserServices']);
Route::post('/services/edit', [ServiceController::class, 'editService']);
