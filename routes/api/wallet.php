<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\WalletController;

Route::get('/wallet/balance', [WalletController::class, 'getWalletBalance']);
Route::get('/wallet/transactions', [WalletController::class, 'getTransactionHistory']);
