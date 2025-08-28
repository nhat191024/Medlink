<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailable;
use Exception;

class MailService
{
    /**
     * Send a simple text email
     *
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param string|null $from
     * @param string|null $fromName
     * @return bool
     */
    public function sendTextEmail($to, $subject, $message, $from = null, $fromName = null)
    {
        try {
            Mail::send([], [], function ($mail) use ($to, $subject, $message, $from, $fromName) {
                $mail->to($to)
                    ->subject($subject)
                    ->setBody($message, 'text/plain');

                if ($from) {
                    $mail->from($from, $fromName);
                }
            });

            $this->logEmail($to, $subject, 'text', 'success');
            return true;
        } catch (Exception $e) {
            $this->logEmail($to, $subject, 'text', 'failed', $e->getMessage());
            Log::error('Failed to send text email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send HTML email with template
     *
     * @param string $to
     * @param string $subject
     * @param string $template
     * @param array $data
     * @param string|null $from
     * @param string|null $fromName
     * @return bool
     */
    public function sendHtmlEmail($to, $subject, $template, $data = [], $from = null, $fromName = null)
    {
        try {
            Mail::send($template, $data, function ($mail) use ($to, $subject, $from, $fromName) {
                $mail->to($to)->subject($subject);

                if ($from) {
                    $mail->from($from, $fromName);
                }
            });

            $this->logEmail($to, $subject, 'html', 'success');
            return true;
        } catch (Exception $e) {
            $this->logEmail($to, $subject, 'html', 'failed', $e->getMessage());
            Log::error('Failed to send HTML email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send email with attachments
     *
     * @param string $to
     * @param string $subject
     * @param string $template
     * @param array $data
     * @param array $attachments
     * @param string|null $from
     * @param string|null $fromName
     * @return bool
     */
    public function sendEmailWithAttachments($to, $subject, $template, $data = [], $attachments = [], $from = null, $fromName = null)
    {
        try {
            Mail::send($template, $data, function ($mail) use ($to, $subject, $attachments, $from, $fromName) {
                $mail->to($to)->subject($subject);

                if ($from) {
                    $mail->from($from, $fromName);
                }

                // Add attachments
                foreach ($attachments as $attachment) {
                    if (is_array($attachment)) {
                        // If attachment is array with options
                        $mail->attach($attachment['path'], $attachment['options'] ?? []);
                    } else {
                        // If attachment is just file path
                        $mail->attach($attachment);
                    }
                }
            });

            $this->logEmail($to, $subject, 'html_with_attachments', 'success');
            return true;
        } catch (Exception $e) {
            $this->logEmail($to, $subject, 'html_with_attachments', 'failed', $e->getMessage());
            Log::error('Failed to send email with attachments: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send bulk emails
     *
     * @param array $recipients
     * @param string $subject
     * @param string $template
     * @param array $data
     * @param string|null $from
     * @param string|null $fromName
     * @return array
     */
    public function sendBulkEmails($recipients, $subject, $template, $data = [], $from = null, $fromName = null)
    {
        $results = [
            'success' => 0,
            'failed' => 0,
            'errors' => []
        ];

        foreach ($recipients as $recipient) {
            $emailData = is_array($recipient) ? array_merge($data, $recipient['data'] ?? []) : $data;
            $email = is_array($recipient) ? $recipient['email'] : $recipient;

            try {
                Mail::send($template, $emailData, function ($mail) use ($email, $subject, $from, $fromName) {
                    $mail->to($email)->subject($subject);

                    if ($from) {
                        $mail->from($from, $fromName);
                    }
                });

                $results['success']++;
                $this->logEmail($email, $subject, 'bulk', 'success');
            } catch (Exception $e) {
                $results['failed']++;
                $results['errors'][] = [
                    'email' => $email,
                    'error' => $e->getMessage()
                ];
                $this->logEmail($email, $subject, 'bulk', 'failed', $e->getMessage());
                Log::error("Failed to send bulk email to {$email}: " . $e->getMessage());
            }
        }

        return $results;
    }

    /**
     * Send email using Mailable class
     *
     * @param string $to
     * @param Mailable $mailable
     * @return bool
     */
    public function sendMailable($to, Mailable $mailable)
    {
        try {
            Mail::to($to)->send($mailable);
            $this->logEmail($to, 'Mailable Email', 'mailable', 'success');
            return true;
        } catch (Exception $e) {
            $this->logEmail($to, 'Mailable Email', 'mailable', 'failed', $e->getMessage());
            Log::error('Failed to send mailable email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Queue email for later sending
     *
     * @param string $to
     * @param Mailable $mailable
     * @param string|null $queue
     * @return bool
     */
    public function queueEmail($to, Mailable $mailable, $queue = null)
    {
        try {
            $mailInstance = Mail::to($to);

            if ($queue) {
                $mailInstance->queue($mailable->onQueue($queue));
            } else {
                $mailInstance->queue($mailable);
            }

            $this->logEmail($to, 'Queued Email', 'queued', 'queued');
            return true;
        } catch (Exception $e) {
            $this->logEmail($to, 'Queued Email', 'queued', 'failed', $e->getMessage());
            Log::error('Failed to queue email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send email with delay
     *
     * @param string $to
     * @param Mailable $mailable
     * @param \DateTimeInterface|\DateInterval|int $delay
     * @return bool
     */
    public function sendEmailLater($to, Mailable $mailable, $delay)
    {
        try {
            Mail::to($to)->later($delay, $mailable);
            $this->logEmail($to, 'Delayed Email', 'delayed', 'scheduled');
            return true;
        } catch (Exception $e) {
            $this->logEmail($to, 'Delayed Email', 'delayed', 'failed', $e->getMessage());
            Log::error('Failed to schedule delayed email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Validate email address
     *
     * @param string $email
     * @return bool
     */
    public function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Log email activity
     *
     * @param string $to
     * @param string $subject
     * @param string $type
     * @param string $status
     * @param string|null $error
     * @return void
     */
    private function logEmail($to, $subject, $type, $status, $error = null)
    {
        $logData = [
            'to' => $to,
            'subject' => $subject,
            'type' => $type,
            'status' => $status,
            'timestamp' => now(),
        ];

        if ($error) {
            $logData['error'] = $error;
        }

        Log::channel('mail')->info('Email Activity', $logData);
    }

    /**
     * Test email configuration
     *
     * @param string $testEmail
     * @return bool
     */
    public function testEmailConfiguration($testEmail = null)
    {
        $testEmail = $testEmail ?: config('mail.from.address');

        if (!$testEmail) {
            Log::error('No test email provided and no default from address configured');
            return false;
        }

        return $this->sendTextEmail(
            $testEmail,
            'Test Email Configuration',
            'This is a test email to verify your mail configuration is working correctly.'
        );
    }

    /**
     * Get email statistics
     *
     * @return array
     */
    public function getEmailStats()
    {
        // This would require a database table to store email logs
        // For now, return basic info
        return [
            'total_sent' => 'N/A - Implement email logging table',
            'success_rate' => 'N/A - Implement email logging table',
            'last_sent' => 'N/A - Implement email logging table'
        ];
    }
}
