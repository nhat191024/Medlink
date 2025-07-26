<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Support\Env;

class ProcessDoctorPayment implements ShouldQueue
{
    use Queueable;

    public $appointmentId;

    /**
     * Create a new job instance.
     */
    public function __construct($appointmentId)
    {
        $this->appointmentId = $appointmentId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            DB::beginTransaction();

            $appointment = Appointment::with(['doctor.user', 'service', 'bill'])->find($this->appointmentId);

            if (!$appointment) {
                Log::warning("Appointment not found: {$this->appointmentId}");
                return;
            }

            // Kiểm tra xem appointment vẫn ở trạng thái completed
            if ($appointment->status !== 'completed') {
                Log::info("Appointment {$this->appointmentId} is no longer completed, skipping payment");
                return;
            }

            $doctor = $appointment->doctor;
            $doctorUser = $doctor->user;
            $bill = $appointment->bill;

            if (!$bill) {
                Log::error("No bill found for appointment {$this->appointmentId}");
                return;
            }

            // Kiểm tra xem đã thanh toán cho bác sĩ chưa bằng cách tìm transaction với appointmentId trong meta
            $existingPayment = Transaction::where('payable_type', 'App\Models\User')
                ->where('payable_id', $doctorUser->id)
                ->where('type', 'deposit')
                ->where('meta->appointmentId', $this->appointmentId)
                ->where('meta->type', 'doctor_payment')
                ->first();

            if ($existingPayment) {
                Log::info("Doctor payment already processed for appointment {$this->appointmentId}");
                return;
            }

            // Tính toán số tiền trả cho bác sĩ (ví dụ: 80% tổng bill)
            $doctorCommissionRate = Env('COMMISSION_RATE');
            $total = $bill->total;
            $tax = $bill->taxVAT;
            $totalafterTax = $total - $tax;
            $doctorPayment = $totalafterTax * $doctorCommissionRate;

            $doctorUser->deposit($doctorPayment, [
                'description' => "Thanh toán hoàn thành cuộc hẹn: #{$this->appointmentId}",
                'appointmentId' => $this->appointmentId,
                'type' => 'doctor_payment',
                'commission_rate' => $doctorCommissionRate,
                'bill_total' => $totalafterTax
            ], true);

            DB::commit();

            Log::info("Successfully processed doctor payment for appointment {$this->appointmentId}. Amount: {$doctorPayment}");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to process doctor payment for appointment {$this->appointmentId}: " . $e->getMessage());
            throw $e;
        }
    }
}
