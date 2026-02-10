<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class StudentPasswordService
{
    public function sendOtp(Student $student)
    {
        return $student->generateOtp();
    }

    public function verifyOtp(Student $student, $otp)
    {
        if (
            $student->otp !== $otp ||
            !$student->otp_expires_at ||
            now()->greaterThan($student->otp_expires_at)
        ) {
            throw ValidationException::withMessages([
                'otp' => 'Invalid or expired OTP',
            ]);
        }

        return true;
    }

    public function resetPassword(Student $student, $password)
    {
        $student->password = $password;
        $student->clearOtp();

        $student->save();
    }
}
