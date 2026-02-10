<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class AdminLoginController extends Controller
{
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $admin = Admin::where('email', $data['login'])
            ->orWhere('username', $data['login'])
            ->first();

        if (!$admin) {
            return back()->with('error', 'Invalid login details');
        }

        if (Hash::check($data['password'], $admin->password)) {
            Auth::guard('admin')->login(
                $admin,
                $request->boolean('remember')
            );

            $request->session()->regenerate();

            return redirect()->route('log');
        }

        return back()->with('error', 'Invalid login details');
    }
}
