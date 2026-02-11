<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Admin;
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
        $user = Student::where('email', $request->email)->first()
            ?? Admin::where('email', $request->email)->firstOrFail();

        $otp = $this->service->sendOtp($user);

        Mail::to($user->email)->send(new StudentOtpMail($otp));

        return redirect()->route('student.verify-otp')
            ->with('email', $user->email)
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
        $user = Student::where('email', $request->email)->first()
            ?? Admin::where('email', $request->email)->firstOrFail();

        $this->service->verifyOtp($user, $request->otp);

        return redirect()->route('student.reset-password', $user->id)
            ->with('success', 'OTP verified! You can reset your password.');
    }

    public function showResetForm($id)
    {
        $user = Student::find($id) ?? Admin::findOrFail($id);

        return view('auth.student-reset-password', ['student' => $user]);
    }

    public function resetPassword(StudentResetPasswordRequest $request, $id)
    {
        $user = Student::find($id);
        $guard = 'student';

        if (!$user) {
            $user = Admin::findOrFail($id);
            $guard = 'admin';
        }

        $this->service->resetPassword($user, $request->password);

        $user->clearOtp();

        Auth::guard($guard)->login($user);

        request()->session()->regenerate();

        return redirect()->route($guard . '.dashboard')
            ->with('success', 'Password reset successfully!');
    }
}
