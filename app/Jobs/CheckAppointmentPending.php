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

class CheckAppointmentPending implements ShouldQueue
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
        $appointment = Appointment::find($this->appointmentId);
        $patientProfile = PatientProfile::find($appointment->patient_profile_id ?? null);

        if (!$appointment) {
            Log::warning("Appointment not found: {$this->appointmentId}");
            return;
        }

        if ($appointment->status !== 'pending') {
            Log::info("Appointment {$this->appointmentId} is no longer in pending, current status: {$appointment->status}");

            if ($appointment->status === 'upcoming') {
                CheckAppointmentUpcoming::dispatch($this->appointmentId)->delay(now()->addMinutes(55));
            }

            return;
        }

        $appointment->update(['status' => 'cancelled']);

        $user = User::find($patientProfile->user_id ?? null);
        $user->notify(
            Notification::make()
                ->title('Bác sĩ không xác nhận hẹn')
                ->body(
                    "Bác sĩ không xác nhận hẹn khám của bạn vào lúc {$appointment->date} {$appointment->time}. Vui lòng thử lại sau."
                )
                ->danger()
                ->toDatabase()
        );

        $doctorProfile = DoctorProfile::find($appointment->doctor_profile_id ?? null);
        $doctor = User::find($doctorProfile->user_id ?? null);
        $doctor->notify(
            Notification::make()
                ->title('Lịch hẹn bị hủy')
                ->body(
                    "Lịch hẹn khám với bệnh nhân {$patientProfile->full_name} vào lúc {$appointment->date} {$appointment->time} đã bị hủy do không được xác nhận."
                )
                ->danger()
                ->toDatabase()
        );

        $mail = config('app.env') === 'production' ? $user->email : 'richberchannel01@gmail.com';

        MailHelper::sendNotification(
            $mail,
            'Lịch hẹn bị hủy',
            "Lịch hẹn khám của bạn vào lúc {$appointment->date} {$appointment->time} đã bị hủy do bác sĩ không xác nhận. Vui lòng thử lại sau.",
            null,
            null
        );

        Log::info("Appointment {$this->appointmentId} status updated to 'cancelled' due to pending status without confirmation.");

        app(AppointmentService::class)->clearAppointmentRelatedCache($appointment);
    }
}
