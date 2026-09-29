<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    /**
     * Show the change password form for authenticated students
     */
    public function showChangePasswordForm()
    {
        $student = auth('student')->user();
        return view('student.change-password', ['student' => $student]);
    }

    /**
     * Handle password change for authenticated students
     */
    public function changePassword()
    {
        $validated = request()->validate([
            'current_password' => [
                'required',
                'string',
                'min:6',
                function ($attribute, $value, $fail) {
                    $student = auth('student')->user();
                    if (!Hash::check($value, $student->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'new_password' => 'required|string|min:8|confirmed|different:current_password',
            'new_password_confirmation' => 'required',
        ]);

        $student = auth('student')->user();
        $student->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Password changed successfully! Please log in again.');
    }
}
