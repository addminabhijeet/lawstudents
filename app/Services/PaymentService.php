<?php

namespace App\Services;

use App\Exceptions\PaymentException;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentService
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Initiate payment for course
     */
    public function initiatePayment(Student $student, Course $course): array
    {
        // Check for duplicate payment in progress
        $existingPayment = Payment::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->whereIn('status', ['pending', 'processing'])
            ->first();

        if ($existingPayment) {
            throw new PaymentException(
                'A payment for this course is already in progress',
                PaymentException::DUPLICATE_PAYMENT
            );
        }

        // Validate amount
        if (!$course->price || $course->price <= 0) {
            throw new PaymentException('Invalid course price', PaymentException::INVALID_AMOUNT);
        }

        try {
            $amount = $course->price;
            $tax = $amount * (config('payment.tax_rate') / 100);
            $totalAmount = $amount + $tax;

            // Create payment record
            $payment = Payment::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'amount' => $amount,
                'tax' => $tax,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'transaction_id' => 'TXN_' . Str::random(16),
                'gateway' => config('payment.gateway'),
            ]);

            Log::info('Payment initiated', ['payment_id' => $payment->id, 'student_id' => $student->id]);

            return [
                'success' => true,
                'payment_id' => $payment->id,
                'amount' => $totalAmount,
                'currency' => config('payment.currency'),
            ];
        } catch (\Exception $e) {
            Log::error('Failed to initiate payment', ['error' => $e->getMessage()]);
            throw new PaymentException('Failed to initiate payment', PaymentException::PAYMENT_FAILED);
        }
    }

    /**
     * Verify and process payment
     */
    public function verifyPayment(string $paymentId, array $gatewayData): bool
    {
        try {
            $payment = Payment::findOrFail($paymentId);

            // Verify against gateway (Razorpay example)
            if (!$this->verifyWithGateway($payment, $gatewayData)) {
                throw new PaymentException('Payment verification failed', PaymentException::GATEWAY_ERROR);
            }

            // Update payment status
            $payment->update([
                'status' => 'completed',
                'gateway_response' => json_encode($gatewayData),
                'verified_at' => now(),
            ]);

            // Enroll student in course
            $this->enrollStudentInCourse($payment->student, $payment->course);

            // Send confirmation
            $this->notificationService->sendPaymentConfirmation(
                $payment->student->email,
                [
                    'transaction_id' => $payment->transaction_id,
                    'amount' => $payment->total_amount,
                    'course_name' => $payment->course->title,
                    'date' => now()->format('M d, Y'),
                ]
            );

            Log::info('Payment verified and completed', ['payment_id' => $payment->id]);

            return true;
        } catch (PaymentException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Payment verification error', ['error' => $e->getMessage()]);
            throw new PaymentException('Payment processing error', PaymentException::PAYMENT_FAILED);
        }
    }

    /**
     * Process refund for payment
     */
    public function processRefund(string $paymentId, string $reason = null): array
    {
        try {
            $payment = Payment::findOrFail($paymentId);

            if ($payment->status !== 'completed') {
                throw new PaymentException('Only completed payments can be refunded', PaymentException::REFUND_FAILED);
            }

            // Check refund window
            $refundWindow = config('payment.refund.refund_window_days');
            if ($payment->verified_at->diffInDays(now()) > $refundWindow) {
                throw new PaymentException(
                    "Refunds are only available within {$refundWindow} days of payment",
                    PaymentException::REFUND_FAILED
                );
            }

            // Process refund with gateway
            $refundPercentage = config('payment.refund.refund_percentage');
            $refundAmount = ($payment->total_amount * $refundPercentage) / 100;

            $payment->update([
                'status' => 'refunded',
                'refund_amount' => $refundAmount,
                'refund_reason' => $reason,
                'refunded_at' => now(),
            ]);

            Log::info('Refund processed', ['payment_id' => $payment->id, 'refund_amount' => $refundAmount]);

            return [
                'success' => true,
                'refund_amount' => $refundAmount,
                'message' => 'Refund has been processed',
            ];
        } catch (PaymentException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Refund processing error', ['error' => $e->getMessage()]);
            throw new PaymentException('Refund processing failed', PaymentException::REFUND_FAILED);
        }
    }

    /**
     * Verify payment with payment gateway
     */
    protected function verifyWithGateway(Payment $payment, array $gatewayData): bool
    {
        // This would be implemented based on the payment gateway
        // For Razorpay, verify the signature
        // This is a placeholder implementation
        return isset($gatewayData['razorpay_payment_id']);
    }

    /**
     * Enroll student in course after successful payment
     */
    protected function enrollStudentInCourse(Student $student, Course $course): void
    {
        // Implement course enrollment logic
        // This might create a record in a student_courses table or similar
        Log::info('Student enrolled in course', ['student_id' => $student->id, 'course_id' => $course->id]);
    }
}
