<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FavoriteController;

Route::get('/favorite/doctor', [FavoriteController::class, 'favoriteDoctor']);
