<?php

namespace App\Jobs;

use App\Models\Bill;
use App\Models\Appointment;

use App\Http\Services\PaymentService;

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
    public $paymentMethod;
    public $servicePrice;
    private $paymentService;

    public function __construct(Appointment $appointment, string $paymentMethod, float $servicePrice)
    {
        $this->appointment = $appointment;
        $this->paymentMethod = $paymentMethod;
        $this->servicePrice = $servicePrice;
        $this->paymentService = app(PaymentService::class);
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $paymentResult = $this->paymentService->processAppointmentPayment(
                $this->appointment,
                $this->paymentMethod,
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
            'payment_method' => $this->paymentMethod,
            'taxVAT' => $this->servicePrice * 0.10, // Assuming VAT is 10%
            'total' => $this->servicePrice + $this->servicePrice * 0.10,
            'status' => 'paid',
        ]);
    }
}
