<?php

namespace App\Exceptions;

use Exception;

class PaymentException extends Exception
{
    public const PAYMENT_FAILED = 'payment_failed';
    public const INVALID_AMOUNT = 'invalid_amount';
    public const GATEWAY_ERROR = 'gateway_error';
    public const REFUND_FAILED = 'refund_failed';
    public const DUPLICATE_PAYMENT = 'duplicate_payment';
    public const PAYMENT_EXPIRED = 'payment_expired';

    protected $code = 'payment_error';

    public function __construct(string $message = '', string $type = self::PAYMENT_FAILED, int $status = 422)
    {
        parent::__construct($message ?: $this->getDefaultMessage($type), $status);
        $this->code = $type;
    }

    private function getDefaultMessage(string $type): string
    {
        return match($type) {
            self::PAYMENT_FAILED => 'Payment processing failed. Please try again or use a different payment method.',
            self::INVALID_AMOUNT => 'Invalid payment amount specified.',
            self::GATEWAY_ERROR => 'Payment gateway error. Please try again later.',
            self::REFUND_FAILED => 'Refund processing failed.',
            self::DUPLICATE_PAYMENT => 'This payment has already been processed.',
            self::PAYMENT_EXPIRED => 'Payment session expired. Please try again.',
            default => 'A payment error occurred.',
        };
    }

    public function render()
    {
        return response()->json([
            'success' => false,
            'message' => $this->message,
            'error' => $this->code,
        ], $this->code);
    }
}
