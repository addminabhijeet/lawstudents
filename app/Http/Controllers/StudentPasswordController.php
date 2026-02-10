<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentOtpMail;
use App\Services\StudentPasswordService;
use App\Http\Requests\StudentSendOtpRequest;
use App\Http\Requests\StudentVerifyOtpRequest;
use App\Http\Requests\StudentResetPasswordRequest;

class StudentPasswordController extends Controller
{
    protected StudentPasswordService $service;

    public function __construct(StudentPasswordService $service)
    {
        $this->service = $service;
    }

    public function showForgotForm()
    {
        return view('auth.student-forgot-password');
    }

    public function sendOtp(StudentSendOtpRequest $request)
    {
        $student = Student::where('email', $request->email)->firstOrFail();

        $otp = $this->service->sendOtp($student);

        Mail::to($student->email)->send(new StudentOtpMail($otp));

        return redirect()->route('student.verify-otp')
            ->with('email', $student->email)
            ->with('success', 'OTP sent to your email!');
    }

    public function showVerifyOtpForm()
    {
        $email = session('email');
        if (!$email) return redirect()->route('student.forgot');

        return view('auth.student-verify-otp', compact('email'));
    }

    public function verifyOtp(StudentVerifyOtpRequest $request)
    {
        $student = Student::where('email', $request->email)->firstOrFail();

        $this->service->verifyOtp($student, $request->otp);

        return redirect()->route('student.reset-password', $student->id)
            ->with('success', 'OTP verified! You can reset your password.');
    }

    public function showResetForm(Student $student)
    {
        return view('auth.student-reset-password', compact('student'));
    }

    public function resetPassword(StudentResetPasswordRequest $request, Student $student)
    {
        $this->service->resetPassword($student, $request->password);

        return redirect()->route('login')
            ->with('success', 'Password reset successfully!');
    }
}
