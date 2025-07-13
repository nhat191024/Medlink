<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Get the wallet balance.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWalletBalance()
    {
        //TODO: Logic to get wallet balance
        return response()->json(['balance' => 100.00]);
    }

    /**
     * Get the wallet transaction history.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTransactionHistory()
    {
        //TODO: Logic to get transaction history
        return response()->json([
            //return null for now
            'transactions' => null
        ]);
    }
}
