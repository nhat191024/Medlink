<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class DoctorImportFailed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $errorMessage;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'doctor_import_failed',
            'title' => 'Import Doctor Failed',
            'message' => "Import doctor thất bại: {$this->errorMessage}",
            'data' => [
                'error_message' => $this->errorMessage,
            ],
            'created_at' => now(),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'doctor_import_failed',
            'error_message' => $this->errorMessage,
        ];
    }
}
