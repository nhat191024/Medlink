<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;
use App\Models\Appointment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'id' => 'qr_transfer',
                'icon' => 'assets/icons/Money.svg',
                'info' => 'Pay through bank with QR code',
                'provider' => 'Payos',
                'expiry' => null,
                'is_card' => false,
            ],
        ];
        return response()->json(['methods' => $data], Response::HTTP_OK);
    }

    public function changePaymentStatus(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|exists:bills,id',
            'status' => 'required|in:PAID,UNPAID,CANCELLED',
        ]);

        try {
            DB::beginTransaction();

            $bill = Bill::find($request->input('id'));
            $status = $request->input('status');

            $status = strtolower($status);

            $bill->status = $status;
            $bill->save();

            DB::commit();

            return response()->json(['message' => 'Payment status changed successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to change payment status', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
