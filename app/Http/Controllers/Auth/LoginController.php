<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth-login-minimal');
    }

    public function loginsubmit(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        // ===== ADMIN LOGIN =====
        $admin = Admin::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin, $request->remember);
            return redirect('/admin/dashboard');
        }

        // ===== STUDENT LOGIN =====
        $student = Student::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->first();

        if ($student && Hash::check($request->password, $student->password)) {
            Auth::guard('student')->login($student, $request->remember);
            return redirect('/student/dashboard');
        }

        return back()->with('error', 'Invalid login details');
    }
}
