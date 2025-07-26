<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessDoctorPayment;
use App\Models\Appointment;

class TestDoctorPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:doctor-payment {appointment_id : ID của appointment để test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test job thanh toán cho bác sĩ với appointment ID cụ thể';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appointmentId = $this->argument('appointment_id');

        $appointment = Appointment::find($appointmentId);

        if (!$appointment) {
            $this->error("Appointment với ID {$appointmentId} không tồn tại!");
            return 1;
        }

        $this->info("Đang test job thanh toán cho appointment ID: {$appointmentId}");
        $this->info("Status hiện tại: {$appointment->status}");

        // Dispatch job ngay lập tức để test (không delay)
        ProcessDoctorPayment::dispatch($appointmentId);

        $this->info("Job đã được dispatch! Chạy 'php artisan queue:work' để xử lý job.");

        return 0;
    }
}
