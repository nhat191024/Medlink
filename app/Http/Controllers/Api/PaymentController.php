<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function getPaymentMethods()
    {
        // Logic to retrieve payment methods
        //TODO: add logic to take user walet balance and credits card
        //* only support QR code payment for now
        $data = [
            [
                'name' => 'QR Code',
                'icon' => 'assets/icons/Money.svg',
                'info' => 'Pay through bank with QR code',
                'provider' => 'Payos',
                'expiry' => null,
            ],
        ];
        return response()->json(['methods' => $data], Response::HTTP_OK);
    }
}
