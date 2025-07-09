<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PaymentController;

Route::get('/payment/methods', [PaymentController::class, 'getPaymentMethods']);
