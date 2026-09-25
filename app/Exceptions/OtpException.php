<?php

namespace App\Exceptions;

use Exception;

class OtpException extends Exception
{
    public const INVALID_OTP = 'invalid_otp';
    public const OTP_EXPIRED = 'otp_expired';
    public const RATE_LIMITED = 'rate_limited';
    public const MAX_ATTEMPTS_EXCEEDED = 'max_attempts_exceeded';
    public const OTP_NOT_SENT = 'otp_not_sent';
    public const INVALID_FORMAT = 'invalid_format';

    protected $code = 'otp_error';

    public function __construct(string $message = '', string $type = self::INVALID_OTP, int $status = 422)
    {
        parent::__construct($message ?: $this->getDefaultMessage($type), $status);
        $this->code = $type;
    }

    private function getDefaultMessage(string $type): string
    {
        return match($type) {
            self::INVALID_OTP => 'Invalid OTP. Please check and try again.',
            self::OTP_EXPIRED => 'OTP has expired. Please request a new one.',
            self::RATE_LIMITED => 'Too many OTP requests. Please wait before trying again.',
            self::MAX_ATTEMPTS_EXCEEDED => 'Maximum verification attempts exceeded. Please request a new OTP.',
            self::OTP_NOT_SENT => 'Failed to send OTP. Please try again later.',
            self::INVALID_FORMAT => 'OTP must be 6 digits.',
            default => 'An OTP error occurred.',
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
