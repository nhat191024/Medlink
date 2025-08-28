<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use App\Helper\MailHelper;
use App\Mail\WelcomeEmail;
use App\Mail\NotificationEmail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MailController extends Controller
{
    protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Send test email
     */
    public function sendTestEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        $result = $this->mailService->sendTextEmail(
            $request->email,
            $request->subject,
            $request->message
        );

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Email đã được gửi thành công!' : 'Gửi email thất bại!'
        ]);
    }

    /**
     * Send welcome email
     */
    public function sendWelcomeEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string'
        ]);

        $user = (object) [
            'email' => $request->email,
            'name' => $request->name
        ];

        $customData = [
            'welcome_message' => $request->welcome_message ?? 'Chúng tôi hy vọng bạn sẽ có trải nghiệm tuyệt vời!',
            'activation_url' => $request->activation_url
        ];

        $result = MailHelper::sendWelcomeEmail($user, $customData);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Email chào mừng đã được gửi!' : 'Gửi email chào mừng thất bại!'
        ]);
    }

    /**
     * Send notification email
     */
    public function sendNotificationEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'title' => 'required|string',
            'message' => 'required|string'
        ]);

        $result = MailHelper::sendNotification(
            $request->email,
            $request->title,
            $request->message,
            $request->action_url,
            $request->action_text
        );

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Email thông báo đã được gửi!' : 'Gửi email thông báo thất bại!'
        ]);
    }

    /**
     * Send bulk emails
     */
    public function sendBulkEmails(Request $request): JsonResponse
    {
        $request->validate([
            'emails' => 'required|array',
            'emails.*' => 'email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        $result = MailHelper::sendBulkPromotion(
            $request->emails,
            $request->subject,
            $request->message,
            $request->action_url
        );

        return response()->json([
            'success' => $result['success'] > 0,
            'data' => $result,
            'message' => "Đã gửi thành công {$result['success']} email, thất bại {$result['failed']} email"
        ]);
    }

    /**
     * Send report email
     */
    public function sendReportEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'report_title' => 'required|string',
            'report_data' => 'required|array'
        ]);

        $reportData = [
            'title' => $request->report_title,
            'description' => $request->report_description ?? 'Báo cáo từ hệ thống',
            'summary' => $request->report_summary,
            'data' => $request->report_data,
            'generated_at' => now()->format('d/m/Y H:i:s')
        ];

        $result = MailHelper::sendReport(
            $request->email,
            $reportData,
            $request->attachment_path
        );

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Email báo cáo đã được gửi!' : 'Gửi email báo cáo thất bại!'
        ]);
    }

    /**
     * Send appointment reminder
     */
    public function sendAppointmentReminder(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'appointment_date' => 'required|string',
            'appointment_time' => 'required|string',
            'location' => 'required|string'
        ]);

        $appointmentData = [
            'date' => $request->appointment_date,
            'time' => $request->appointment_time,
            'location' => $request->location,
            'details_url' => $request->details_url
        ];

        $result = MailHelper::sendAppointmentReminder($request->email, $appointmentData);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Email nhắc nhở lịch hẹn đã được gửi!' : 'Gửi email nhắc nhở thất bại!'
        ]);
    }

    /**
     * Test email configuration
     */
    public function testConfiguration(Request $request): JsonResponse
    {
        $testEmail = $request->test_email ?? config('mail.from.address');

        $result = MailHelper::testConfiguration($testEmail);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Cấu hình email hoạt động bình thường!' : 'Cấu hình email có vấn đề!',
            'test_email' => $testEmail
        ]);
    }

    /**
     * Get email stats
     */
    public function getEmailStats(): JsonResponse
    {
        $stats = $this->mailService->getEmailStats();

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Queue email for later sending
     */
    public function queueEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'type' => 'required|in:welcome,notification,report',
            'data' => 'required|array'
        ]);

        $mailable = null;

        switch ($request->type) {
            case 'welcome':
                $user = (object) $request->data['user'];
                $mailable = new WelcomeEmail($user, $request->data['custom_data'] ?? []);
                break;

            case 'notification':
                $mailable = new NotificationEmail(
                    $request->data['title'],
                    $request->data['message'],
                    $request->data['action_url'] ?? null,
                    $request->data['action_text'] ?? null
                );
                break;
        }

        if (!$mailable) {
            return response()->json([
                'success' => false,
                'message' => 'Loại email không hợp lệ!'
            ]);
        }

        $result = $this->mailService->queueEmail(
            $request->email,
            $mailable,
            $request->queue_name
        );

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Email đã được thêm vào hàng đợi!' : 'Thêm email vào hàng đợi thất bại!'
        ]);
    }
}
