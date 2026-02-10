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
        $data = $request->validate([
            'login' => ['required','string'],
            'password' => ['required','string'],
        ]);

        if ($admin = Admin::where('email',$data['login'])
            ->orWhere('username',$data['login'])->first()) {

            if (!Hash::isHashed($admin->password)) {
                $admin->update(['password'=>bcrypt($admin->password)]);
            }

            if (Hash::check($data['password'],$admin->password)) {
                Auth::guard('admin')->login($admin,$request->boolean('remember'));
                return redirect()->route('log');
            }
        }

        if ($student = Student::where('email',$data['login'])
            ->orWhere('username',$data['login'])->first()) {

            if (!Hash::isHashed($student->password)) {
                $student->update(['password'=>bcrypt($student->password)]);
            }

            if (Hash::check($data['password'],$student->password)) {
                Auth::guard('student')->login($student,$request->boolean('remember'));
                return redirect()->route('login');
            }
        }

        return back()->with('error','Invalid login details');
    }

    public function registersubmit(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'=>'required|string|max:100',
            'username'=>'required|string|max:100|unique:admins',
            'email'=>'required|email|max:150|unique:admins',
            'password'=>'required|confirmed|min:6',
        ]);

        $admin = Admin::create($data);

        Auth::guard('admin')->login($admin);

        return redirect()->route('login')
            ->with('success','Registration successful. Please login.');
    }

    public function registerstusubmit(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'=>'required|string|max:100',
            'username'=>'required|string|max:100|unique:students',
            'email'=>'required|email|max:150|unique:students',
            'password'=>'required|confirmed|min:6',
        ]);

        $student = Student::create($data);

        Auth::guard('student')->login($student);

        return redirect()->route('login')
            ->with('success','Student registration successful.');
    }
}
