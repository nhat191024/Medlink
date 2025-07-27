<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Http\Services\AppointmentService;

class UpdateAppointmentStatus implements ShouldQueue
{
    use Queueable;

    protected $appointmentId;

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
            $appointment = Appointment::find($this->appointmentId);

            if (!$appointment) {
                Log::warning("Appointment not found: {$this->appointmentId}");
                return;
            }

            // Kiểm tra xem appointment vẫn ở trạng thái upcoming
            if ($appointment->status !== 'upcoming') {
                Log::info("Appointment {$this->appointmentId} is no longer upcoming, current status: {$appointment->status}");
                return;
            }

            // Parse thời gian appointment để kiểm tra xem đã đến giờ chưa
            $appointmentDateTime = $this->parseAppointmentDateTime($appointment->date, $appointment->time);

            if (!$appointmentDateTime) {
                Log::error("Could not parse appointment datetime for appointment {$this->appointmentId}");
                return;
            }

            $now = Carbon::now();

            // Chỉ chuyển trạng thái nếu đã đến giờ hẹn (có thể cho phép sớm 5 phút)
            if ($now->gte($appointmentDateTime->subMinutes(5))) {
                $appointment->update(['status' => 'waiting']);

                Log::info("Updated appointment {$this->appointmentId} status from 'upcoming' to 'waiting'");

                // Clear cache nếu cần
                app(AppointmentService::class)->clearAppointmentRelatedCache($appointment);
            } else {
                Log::info("Appointment {$this->appointmentId} time has not arrived yet. Scheduled for: {$appointmentDateTime}, Current: {$now}");
            }
        } catch (\Exception $e) {
            Log::error("Error updating appointment status for appointment {$this->appointmentId}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Parse appointment date and time to Carbon instance
     *
     * @param string $date Format: 2026-06-25
     * @param string $time Format: 01:00 PM - 01:30 PM
     * @return Carbon|null
     */
    private function parseAppointmentDateTime($date, $time)
    {
        try {
            // Extract start time from time range (01:00 PM - 01:30 PM -> 01:00 PM)
            $timeRange = explode(' - ', $time);
            $startTime = trim($timeRange[0]);

            // Combine date and start time
            $dateTimeString = $date . ' ' . $startTime;

            // Parse using Carbon
            return Carbon::createFromFormat('Y-m-d h:i A', $dateTimeString);
        } catch (\Exception $e) {
            Log::error("Error parsing appointment datetime. Date: {$date}, Time: {$time}, Error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("UpdateAppointmentStatus job failed for appointment {$this->appointmentId}: " . $exception->getMessage());
    }
}
