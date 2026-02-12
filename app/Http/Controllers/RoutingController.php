<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RoutingController extends Controller
{
    public function root()
    {
        return view('demo.index');
    }

    public function log()
    {
        return view('leads-view');
    }

    public function login()
    {
        return view('auth.auth-login-minimal');
    }

    public function verify()
    {
        return view('auth.student-verify-otp');
    }

    public function register()
    {
        return view('auth.auth-register-minimal');
    }

    public function registerstu()
    {
        return view('auth.auth-registerstu-minimal');
    }

    public function liststudent()
    {
        return view('student.payment');
    }

    public function listadmission()
    {
        return view('admission.payment');
    }

    public function addadmission()
    {
        return view('admission.proposal-create');
    }

    public function student()
    {
        return view('student.indexstu');
    }

    public function addstudent()
    {
        return view('student.proposal-create');
    }

    public function admin()
    {
        return view('admin.indexone');
    }

    /**
     * First level route
     */
    public function firstLevel(Request $request, $first)
    {
        if (View::exists($first)) {
            return view($first);
        }

        abort(404);
    }

    /**
     * Second level route
     */
    public function secondLevel(Request $request, $first, $second)
    {
        $view = $first . '.' . $second;

        if (View::exists($view)) {
            return view($view);
        }

        abort(404);
    }

    /**
     * Third level route
     */
    public function thirdLevel(Request $request, $first, $second, $third)
    {
        $view = $first . '.' . $second . '.' . $third;

        if (View::exists($view)) {
            return view($view);
        }

        abort(404);
    }
}
