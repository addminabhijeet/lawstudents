<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

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

        if ($admin) {
            // Check if password is bcrypt before calling Hash::check
            if (!preg_match('/^\$2y\$/', $admin->password)) {
                // If not hashed, hash it (one-time fix)
                $admin->password = bcrypt($admin->password);
                $admin->save();
            }

            if (Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->login($admin, $request->remember);
                return redirect()->route('log');
            }
        }

        // ===== STUDENT LOGIN =====
        $student = Student::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->first();

        if ($student) {
            if (!preg_match('/^\$2y\$/', $student->password)) {
                $student->password = bcrypt($student->password);
                $student->save();
            }

            if (Hash::check($request->password, $student->password)) {
                Auth::guard('student')->login($student, $request->remember);
                return redirect()->route('loginstu');
            }
        }

        return back()->with('error', 'Invalid login details');
    }


    public function registersubmit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:admins',
            'email' => 'required|email|max:150|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Create admin
        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password, // auto-hashed in Admin model
        ]);

        // Login the admin
        Auth::guard('admin')->login($admin);

        // Redirect to login route with success message
        return redirect()->route('login')
            ->with('success', 'Registration successful. Please login.');
    }

    public function registerstusubmit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:students',
            'email' => 'required|email|max:150|unique:students',
            'password' => 'required|confirmed|min:6',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create student
        $student = Student::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password, // auto-hashed in Student model
        ]);

        // Login the student
        Auth::guard('student')->login($student);

        // Redirect to student dashboard or login
        return redirect()->route('login')
            ->with('success', 'Student registration successful. Please login.');
    }
}
