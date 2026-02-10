<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function loginsubmit(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        if (Auth::guard('admin')->attempt([
            $loginField => $credentials['login'],
            'password' => $credentials['password'],
        ], $remember)) {

            $request->session()->regenerate();

            return redirect()->route('admin');
        }

        return back()->with('error', 'Invalid admin credentials');
    }

    public function registersubmit(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:admins',
            'email' => 'required|email|max:150|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]);

        $admin = Admin::create($data);

        Auth::guard('admin')->login($admin);

        return redirect()->route('login')
            ->with('success', 'Registration successful. Please login.');
    }

    public function registerstusubmit(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:students',
            'email' => 'required|email|max:150|unique:students',
            'password' => 'required|confirmed|min:6',
        ]);

        $student = Student::create($data);

        Auth::guard('student')->login($student);

        return redirect()->route('login')
            ->with('success', 'Student registration successful.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
