<?php

namespace App\Jobs;

use App\Models\Bill;
use App\Models\Appointment;

use App\Http\Services\AppointmentService;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;


class ProcessAppointmentPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $appointment;
    public $payment_method;
    public $service_price;

    public function __construct(Appointment $appointment, string $paymentMethod, float $servicePrice)
    {
        $this->appointment = $appointment;
        $this->payment_method = $paymentMethod;
        $this->service_price = $servicePrice;
    }


    /**
     * Execute the job.
     */
    public function handle(AppointmentService $appointmentService): void
    {
        try {
            $paymentResult = $appointmentService->processAppointmentPayment(
                $this->appointment,
                $this->payment_method,
            );

            $this->createBill($paymentResult);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the payment process
            Log::error('Payment processing failed: ' . $e->getMessage());
            return;
        }
    }

    private function createBill($paymentResult)
    {
        Bill::create([
            'appointment_id' => $this->appointment->id,
            'payment_method' => $this->payment_method,
            'taxVAT' => $this->service_price * 0.10, // Assuming VAT is 10%
            'total' => $this->service_price + $this->service_price * 0.10,
            'status' => 'paid',
        ]);
    }
}
