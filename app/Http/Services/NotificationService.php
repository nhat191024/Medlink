<?php

namespace App\Http\Services;

use Carbon\Carbon;

class NotificationService
{
    /**
     * Map notifications to response format
     *
     * @param \Illuminate\Support\Collection $notifications
     */
    public function mapNotifications($notifications)
    {
        return $notifications->map(function ($notification) {
            $appointment = $notification->appointment;
            $appointmentDate = $appointment ? Carbon::parse($appointment->date) : null;
            $dayOfWeekShort =  $appointment ? Carbon::parse($appointment->day_of_week)->format('D') : null;
            $isHaveAppointment = $appointment ?? false;

            return [
                'id' => $notification->id,
                'title' => $notification->title,
                'appointment_id' => $appointment?->id,
                'appointment_date' => $isHaveAppointment ? $dayOfWeekShort . ', ' . $appointmentDate->format('d M Y') : null,
                'appointment_time' => $isHaveAppointment ? $appointment->time : null,
                'appointment_status' => $isHaveAppointment ? $appointment->status : null,
                'service_icon' => $isHaveAppointment ? $notification->appointment->service->icon : null,
                'service_name' => $isHaveAppointment ? $notification->appointment->service->name : null,
                'patient_avatar' => $isHaveAppointment ? asset($notification->appointment->patient->avatar) : null,
                'is_new' => $notification->created_at->diffInMinutes(Carbon::now()) < 60,
                'status' => $notification->status,
                'created_at' => $notification->created_at->diffForHumans()
            ];
        });
    }
}
