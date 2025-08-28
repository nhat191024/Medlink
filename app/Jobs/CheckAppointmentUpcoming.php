<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Models\PatientProfile;
use App\Models\DoctorProfile;
use App\Models\User;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

use Filament\Notifications\Notification;

use App\Http\Services\AppointmentService;

use App\Helper\MailHelper;

use Carbon\Carbon;

class CheckAppointmentUpcoming implements ShouldQueue
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
            $patientProfile = PatientProfile::find($appointment->patient_profile_id ?? null);

            if (!$appointment) {
                Log::warning("Appointment not found: {$this->appointmentId}");
                return;
            }

            if ($appointment->status !== 'upcoming') {
                Log::info("Appointment {$this->appointmentId} is no longer upcoming, current status: {$appointment->status}");
                return;
            }

            // Parse appointment date and time
            $appointmentDateTime = $this->parseAppointmentDateTime($appointment->date, $appointment->time);
            if (!$appointmentDateTime) {
                Log::error("Could not parse appointment datetime for appointment {$this->appointmentId}");
                return;
            }

            $now = Carbon::now();

            // Chỉ chuyển trạng thái nếu đã đến giờ hẹn (có thể cho phép sớm 5 phút)
            if ($now->gte($appointmentDateTime->subMinutes(5))) {

                $appointment->update(['status' => 'waiting']);

                $patient = User::find($patientProfile->user_id ?? null);
                $patient->notify(
                    Notification::make()
                        ->title('Sắp đến giờ hẹn khám')
                        ->body(
                            "Sắp đến giờ hẹn khám của bạn vào lúc {$appointment->date} {$appointment->time}. Vui lòng chuẩn bị."
                        )
                        ->danger()
                        ->toDatabase()
                );

                $doctorProfile = DoctorProfile::find($appointment->doctor_profile_id ?? null);
                $doctor = User::find($doctorProfile->user_id ?? null);
                $doctor->notify(
                    Notification::make()
                        ->title('Sắp đến giờ hẹn khám')
                        ->body(
                            "Sắp đến giờ hẹn khám với bệnh nhân {$patientProfile->user->name} vào lúc {$appointment->date} {$appointment->time}. Vui lòng chuẩn bị."
                        )
                        ->danger()
                        ->toDatabase()
                );

                $patientEmail = config('app.env') === 'production' ? $patient->email : 'richberchannel01@gmail.com';
                MailHelper::sendNotification(
                    $patientEmail,
                    'Sắp đến giờ hẹn khám',
                    "Sắp đến giờ hẹn khám của bạn vào lúc {$appointment->date} {$appointment->time}. Vui lòng chuẩn bị.",
                    null,
                    null
                );

                $doctorEmail = config('app.env') === 'production' ? $doctor->email : 'richberchannel01@gmail.com';
                MailHelper::sendNotification(
                    $doctorEmail,
                    'Sắp đến giờ hẹn khám',
                    "Sắp đến giờ hẹn khám với bệnh nhân {$patientProfile->user->name} vào lúc {$appointment->date} {$appointment->time}. Vui lòng chuẩn bị.",
                    null,
                    null
                );

                Log::info("Updated appointment {$this->appointmentId} status from 'upcoming' to 'waiting'");

                app(AppointmentService::class)->clearAppointmentRelatedCache($appointment);
            } else {
                Log::info("Appointment {$this->appointmentId} time has not arrived yet. Scheduled for: {$appointmentDateTime}, Current: {$now}");
                $this->dispatch()->delay($appointmentDateTime->subMinutes(5));
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
