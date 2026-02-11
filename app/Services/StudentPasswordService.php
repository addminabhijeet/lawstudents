<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentPasswordService
{
    public function sendOtp(Authenticatable $user)
    {
        return $user->generateOtp();
    }

    public function verifyOtp(Authenticatable $user, $otp)
    {
        if (
            $user->otp !== $otp ||
            !$user->otp_expires_at ||
            now()->greaterThan($user->otp_expires_at)
        ) {
            throw ValidationException::withMessages([
                'otp' => 'Invalid or expired OTP',
            ]);
        }

        return true;
    }

    public function resetPassword(Authenticatable $user, $password)
    {
        $user->password = $password;
        $user->clearOtp();
        $user->save();
    }
}
