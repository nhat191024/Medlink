<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionResourceCollection;

class TestController extends Controller
{
    public function index()
    {
        $data = null;
        $user = User::find(1); // Assuming user with ID 1 exists
        // $user->deposit(100, ['description' => 'Test deposit',], false);
        // $data = $user->balance;
        // $user->forceWithdraw(10, ['description' => 'payment of taxes']);
        // $data = new TransactionResourceCollection($user->wallet->transactions);
        $data = $user->wallet->transactions->find(1);

        return response()->json($data, 200);
    }
}
