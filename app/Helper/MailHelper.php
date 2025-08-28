<?php

namespace App\Helper;

use App\Services\MailService;
use App\Mail\WelcomeEmail;
use App\Mail\NotificationEmail;
use App\Mail\ReportEmail;

class MailHelper
{
    protected $mailService;

    public function __construct()
    {
        $this->mailService = new MailService();
    }

    /**
     * Send welcome email to new user
     *
     * @param object $user
     * @param array $customData
     * @return bool
     */
    public static function sendWelcomeEmail($user, $customData = [])
    {
        $mailService = new MailService();
        $welcomeEmail = new WelcomeEmail($user, $customData);

        return $mailService->sendMailable($user->email, $welcomeEmail);
    }

    /**
     * Send notification email
     *
     * @param string $to
     * @param string $title
     * @param string $message
     * @param string|null $actionUrl
     * @param string|null $actionText
     * @return bool
     */
    public static function sendNotification($to, $title, $message, $actionUrl = null, $actionText = null)
    {
        $mailService = new MailService();
        $notificationEmail = new NotificationEmail($title, $message, $actionUrl, $actionText);

        return $mailService->sendMailable($to, $notificationEmail);
    }

    /**
     * Send report email
     *
     * @param string $to
     * @param array $reportData
     * @param string|null $attachmentPath
     * @return bool
     */
    public static function sendReport($to, $reportData, $attachmentPath = null)
    {
        $mailService = new MailService();
        $reportEmail = new ReportEmail($reportData, $attachmentPath);

        return $mailService->sendMailable($to, $reportEmail);
    }

    /**
     * Send password reset email
     *
     * @param string $to
     * @param string $resetUrl
     * @return bool
     */
    public static function sendPasswordReset($to, $resetUrl)
    {
        return self::sendNotification(
            $to,
            'Đặt lại mật khẩu',
            'Bạn đã yêu cầu đặt lại mật khẩu. Nhấp vào nút bên dưới để tiếp tục.',
            $resetUrl,
            'Đặt lại mật khẩu'
        );
    }

    /**
     * Send account verification email
     *
     * @param string $to
     * @param string $verificationUrl
     * @return bool
     */
    public static function sendAccountVerification($to, $verificationUrl)
    {
        return self::sendNotification(
            $to,
            'Xác thực tài khoản',
            'Vui lòng xác thực địa chỉ email của bạn để hoàn tất quá trình đăng ký.',
            $verificationUrl,
            'Xác thực email'
        );
    }

    /**
     * Send appointment reminder
     *
     * @param string $to
     * @param array $appointmentData
     * @return bool
     */
    public static function sendAppointmentReminder($to, $appointmentData)
    {
        $message = sprintf(
            'Bạn có lịch hẹn vào %s lúc %s. Địa điểm: %s',
            $appointmentData['date'] ?? 'N/A',
            $appointmentData['time'] ?? 'N/A',
            $appointmentData['location'] ?? 'N/A'
        );

        return self::sendNotification(
            $to,
            'Nhắc nhở lịch hẹn',
            $message,
            $appointmentData['details_url'] ?? null,
            'Xem chi tiết'
        );
    }

    /**
     * Send invoice email
     *
     * @param string $to
     * @param array $invoiceData
     * @param string|null $pdfPath
     * @return bool
     */
    public static function sendInvoice($to, $invoiceData, $pdfPath = null)
    {
        $reportData = [
            'title' => 'Hóa đơn #' . ($invoiceData['invoice_number'] ?? 'N/A'),
            'description' => 'Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.',
            'summary' => sprintf(
                'Tổng tiền: %s - Ngày: %s',
                $invoiceData['total'] ?? 'N/A',
                $invoiceData['date'] ?? date('d/m/Y')
            ),
            'data' => $invoiceData['items'] ?? [],
            'attachment_note' => $pdfPath ? 'Hóa đơn chi tiết được đính kèm dưới dạng file PDF.' : null,
            'generated_at' => now()->format('d/m/Y H:i:s')
        ];

        return self::sendReport($to, $reportData, $pdfPath);
    }

    /**
     * Send bulk promotional email
     *
     * @param array $recipients
     * @param string $subject
     * @param string $message
     * @param string|null $actionUrl
     * @return array
     */
    public static function sendBulkPromotion($recipients, $subject, $message, $actionUrl = null)
    {
        $mailService = new MailService();

        return $mailService->sendBulkEmails(
            $recipients,
            $subject,
            'emails.notification',
            [
                'title' => $subject,
                'message' => $message,
                'actionUrl' => $actionUrl,
                'actionText' => 'Xem chi tiết'
            ]
        );
    }

    /**
     * Test email configuration
     *
     * @param string|null $testEmail
     * @return bool
     */
    public static function testConfiguration($testEmail = null)
    {
        $mailService = new MailService();
        return $mailService->testEmailConfiguration($testEmail);
    }
}
