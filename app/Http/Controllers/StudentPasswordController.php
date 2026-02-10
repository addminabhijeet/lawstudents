<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentOtpMail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StudentPasswordController extends Controller
{
    // Step 1: Show forgot password form
    public function showForgotForm()
    {
        return view('auth.student-forgot-password');
    }

    // Step 2: Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:students,email']);

        $student = Student::where('email', $request->email)->first();

        $otp = $student->generateOtp();
        Mail::to($student->email)->send(new StudentOtpMail($otp));

        return redirect()->route('student.verify-otp')->with('email', $student->email)
            ->with('success', 'OTP sent to your email!');
    }

    // Step 3: Show OTP verification form
    public function showVerifyOtpForm(Request $request)
    {
        $email = session('email');
        if (!$email) return redirect()->route('student.forgot');
        return view('auth.student-verify-otp', compact('email'));
    }

    // Step 4: Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:students,email',
            'otp' => 'required|digits:6'
        ]);

        $student = Student::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->where('otp_expires_at', '>', now())
                    ->first();

        if (!$student) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        $student->clearOtp();

        return redirect()->route('student.reset-password', $student->id)
            ->with('success', 'OTP verified! You can reset your password.');
    }

    // Step 5: Show reset password form
    public function showResetForm(Student $student)
    {
        return view('auth.student-reset-password', compact('student'));
    }

    // Step 6: Reset password
    public function resetPassword(Request $request, Student $student)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $student->password = $request->password;
        $student->save();

        return redirect()->route('login')->with('success', 'Password reset successfully!');
    }
}
