<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Services\PaymentService;
use App\Repositories\PaymentRepository;
use App\Exceptions\PaymentException;
use App\Models\Course;
use Illuminate\Http\Request;

class PaymentController extends BaseApiController
{
    protected PaymentService $paymentService;
    protected PaymentRepository $paymentRepository;

    public function __construct(PaymentService $paymentService, PaymentRepository $paymentRepository)
    {
        $this->paymentService = $paymentService;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Initiate payment for course
     */
    public function initiate(Request $request)
    {
        try {
            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id',
            ]);

            $student = $request->user();
            $course = Course::findOrFail($validated['course_id']);

            $result = $this->paymentService->initiatePayment($student, $course);

            return $this->createdResponse(
                data: $result,
                message: 'Payment initiated successfully'
            );
        } catch (PaymentException $e) {
            return $this->errorResponse($e->getMessage(), $e->code, 422);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to initiate payment', 'payment_error', 500);
        }
    }

    /**
     * Verify payment
     */
    public function verify(Request $request)
    {
        try {
            $validated = $request->validate([
                'payment_id' => 'required|exists:payments,id',
                'razorpay_payment_id' => 'required_if:gateway,razorpay',
                'razorpay_order_id' => 'required_if:gateway,razorpay',
                'razorpay_signature' => 'required_if:gateway,razorpay',
            ]);

            $this->paymentService->verifyPayment(
                $validated['payment_id'],
                $validated
            );

            return $this->successResponse(
                data: ['payment_id' => $validated['payment_id']],
                message: 'Payment verified successfully'
            );
        } catch (PaymentException $e) {
            return $this->errorResponse($e->getMessage(), $e->code, 422);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Payment verification failed', 'verify_error', 500);
        }
    }

    /**
     * Get student's payment history
     */
    public function history(Request $request)
    {
        try {
            $perPage = (int) $request->get('per_page', 15);
            $student = $request->user();

            $payments = $this->paymentRepository->getStudentPayments($student->id, $perPage);

            return $this->paginatedResponse(
                data: $payments->items(),
                paginator: $payments,
                message: 'Payment history retrieved'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch payment history', 'fetch_error', 500);
        }
    }

    /**
     * Request refund
     */
    public function requestRefund(Request $request)
    {
        try {
            $validated = $request->validate([
                'payment_id' => 'required|exists:payments,id',
                'reason' => 'nullable|string|max:500',
            ]);

            $result = $this->paymentService->processRefund(
                $validated['payment_id'],
                $validated['reason'] ?? null
            );

            return $this->successResponse(
                data: $result,
                message: 'Refund processed successfully'
            );
        } catch (PaymentException $e) {
            return $this->errorResponse($e->getMessage(), $e->code, 422);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Refund request failed', 'refund_error', 500);
        }
    }
}
