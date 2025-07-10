<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;
use App\Models\Appointment;

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
        $bill = Bill::findOrFail($request->input('bill_id'));
        $status = $request->input('status');

        $bill->status = $status == 'PAID' ? 'paid' : 'unpaid';
        $bill->save();

        $appointment = Appointment::where('id', $bill->appointment_id)->load('doctor', 'doctor.user', 'doctor.services', 'doctor.medicalCategory')->first();

        $appointmentData = [
            'id' => $appointment->id,
            'doctor' => [
                'id' => $appointment->doctor->id,
                'name' => $appointment->doctor->user->name,
                'avatar' => $appointment->doctor->user->avatar,
                'specialization' => $appointment->doctor->medicalCategory->name,
            ],
            'service' => [
                'icon' => $appointment->service->icon,
                'name' => $appointment->service->name,
            ],
            'time' => `{$appointment->day_of_week}, {$appointment->date}, {$appointment->time}`,
            'appointmentPlace' => $appointment->link ?? $appointment->address,
            'status' => $appointment->status,
        ];

        return response()->json(['message' => 'Payment status changed successfully', $appointmentData], Response::HTTP_OK);
    }
}
