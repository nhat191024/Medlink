<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getPaymentMethods(Request $request)
    {
        // Logic to retrieve payment methods
        //TODO: add logic to take user walet balance and credits card
        //* only support QR code payment for now
        return response()->json(['methods' => ['Bank Transfer']]);
    }
}
