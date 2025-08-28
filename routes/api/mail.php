<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MailController;

Route::prefix('mail')->group(function () {
    Route::post('/test', [MailController::class, 'sendTestEmail']);
    Route::post('/welcome', [MailController::class, 'sendWelcomeEmail']);
    Route::post('/notification', [MailController::class, 'sendNotificationEmail']);
    Route::post('/bulk', [MailController::class, 'sendBulkEmails']);
    Route::post('/report', [MailController::class, 'sendReportEmail']);
    Route::post('/appointment-reminder', [MailController::class, 'sendAppointmentReminder']);
    Route::post('/queue', [MailController::class, 'queueEmail']);
    Route::get('/test-config', [MailController::class, 'testConfiguration']);
    Route::get('/stats', [MailController::class, 'getEmailStats']);
});
