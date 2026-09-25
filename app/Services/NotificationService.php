<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    /**
     * Send OTP via email
     */
    public function sendOtpEmail(string $email, int $otp): bool
    {
        try {
            $subject = 'Your OTP - Law Students Platform';
            $body = "Your One-Time Password (OTP) is: <strong>{$otp}</strong>\n\n"
                  . "This OTP is valid for " . config('otp.validity_minutes') . " minutes.\n"
                  . "Do not share this code with anyone.";

            Mail::raw($body, function ($message) use ($email, $subject) {
                $message->to($email)
                    ->subject($subject)
                    ->from(config('otp.from_email'), config('otp.from_name'));
            });

            Log::info('OTP email sent', ['email' => $email]);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send OTP email', ['email' => $email, 'error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Send OTP via SMS (Fast2SMS)
     */
    public function sendOtpSms(string $phone, int $otp): bool
    {
        try {
            $apiKey = config('services.fast2sms.api_key');
            if (!$apiKey) {
                Log::warning('Fast2SMS API key not configured');
                return false;
            }

            $message = "Your OTP for Law Students Platform is: {$otp}. Valid for " . config('otp.validity_minutes') . " minutes.";

            $response = Http::withHeaders([
                'authorization' => $apiKey,
            ])->get('https://www.fast2sms.com/dev/bulkSms', [
                'phone' => $phone,
                'message' => $message,
            ]);

            if ($response->successful()) {
                Log::info('OTP SMS sent', ['phone' => $phone]);
                return true;
            } else {
                Log::error('Fast2SMS API error', ['phone' => $phone, 'response' => $response->body()]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Failed to send OTP SMS', ['phone' => $phone, 'error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Send contact form confirmation email
     */
    public function sendContactConfirmation(string $email, string $name, string $message): bool
    {
        try {
            $subject = 'We received your message - Law Students Platform';
            $body = "Hello {$name},\n\n"
                  . "Thank you for contacting us. We have received your message and will get back to you soon.\n\n"
                  . "Your message:\n{$message}";

            Mail::raw($body, function ($msg) use ($email, $subject) {
                $msg->to($email)
                    ->subject($subject)
                    ->from(config('otp.from_email'), config('otp.from_name'));
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send contact confirmation', ['email' => $email, 'error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Send payment confirmation email
     */
    public function sendPaymentConfirmation(string $email, array $paymentDetails): bool
    {
        try {
            $subject = 'Payment Confirmation - Law Students Platform';
            $body = "Payment Received!\n\n"
                  . "Transaction ID: {$paymentDetails['transaction_id']}\n"
                  . "Amount: {$paymentDetails['amount']}\n"
                  . "Course: {$paymentDetails['course_name']}\n"
                  . "Date: {$paymentDetails['date']}\n\n"
                  . "You can now access the course materials.";

            Mail::raw($body, function ($msg) use ($email, $subject) {
                $msg->to($email)
                    ->subject($subject)
                    ->from(config('otp.from_email'), config('otp.from_name'));
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send payment confirmation', ['email' => $email, 'error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Send admin notification email
     */
    public function sendAdminNotification(string $subject, string $body, array $recipients): bool
    {
        try {
            Mail::raw($body, function ($msg) use ($subject, $recipients) {
                $msg->to($recipients)
                    ->subject("[Admin] {$subject}")
                    ->from(config('otp.from_email'), 'Admin Notifications');
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification', ['subject' => $subject, 'error' => $e->getMessage()]);
            return false;
        }
    }
}
