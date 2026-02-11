<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

class StudentPasswordService
{
    public function sendOtp(Authenticatable $user): int
    {
        if (!method_exists($user, 'generateOtp')) {
            throw ValidationException::withMessages([
                'email' => ['User model does not support OTP generation.'],
            ]);
        }

        return $user->generateOtp();
    }

    public function verifyOtp(Authenticatable $user, $otp): bool
    {
        if (!$user->otp) {
            throw ValidationException::withMessages([
                'otp' => ['OTP not found. Please request a new one.'],
            ]);
        }

        if (!$user->otp_expires_at instanceof Carbon) {
            throw ValidationException::withMessages([
                'otp' => ['OTP expiration data missing. Request a new OTP.'],
            ]);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            throw ValidationException::withMessages([
                'otp' => ['OTP has expired. Please request a new OTP.'],
            ]);
        }

        if ((string)$user->otp !== (string)$otp) {
            throw ValidationException::withMessages([
                'otp' => ['Invalid OTP entered.'],
            ]);
        }

        return true;
    }

    public function resetPassword(Authenticatable $user, string $password): void
    {
        if (!$password) {
            throw ValidationException::withMessages([
                'password' => ['Password cannot be empty.'],
            ]);
        }

        $user->password = $password;
        $user->save();
    }
}
