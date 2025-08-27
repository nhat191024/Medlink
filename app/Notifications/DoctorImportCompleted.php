<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class DoctorImportCompleted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $importedCount;
    protected $errorCount;
    protected $errors;

    /**
     * Create a new notification instance.
     */
    public function __construct(int $importedCount, int $errorCount, array $errors = [])
    {
        $this->importedCount = $importedCount;
        $this->errorCount = $errorCount;
        $this->errors = $errors;
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
            'type' => 'doctor_import_completed',
            'title' => 'Import Doctor Completed',
            'message' => "Import doctor hoàn thành! Đã import thành công {$this->importedCount} doctor(s)" .
                ($this->errorCount > 0 ? " và có {$this->errorCount} lỗi." : "."),
            'data' => [
                'imported_count' => $this->importedCount,
                'error_count' => $this->errorCount,
                'errors' => array_slice($this->errors, 0, 10), // Chỉ lưu 10 lỗi đầu tiên
                'total_errors' => count($this->errors),
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
            'type' => 'doctor_import_completed',
            'imported_count' => $this->importedCount,
            'error_count' => $this->errorCount,
            'errors' => $this->errors,
        ];
    }
}
