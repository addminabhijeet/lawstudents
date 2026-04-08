<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(): View
    {
        return view('contact.contact');
    }

    public function contactstore(Request $request)
    {
        // Validation
        $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'phone'        => 'required|digits:10',
            'email'        => 'required|email|max:150',
            'service_type' => 'required|string|max:150',
            'message'      => 'required|string',
        ]);

        // Store Data
        ContactForm::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'service_type' => $request->service_type,
            'message'      => $request->message,
        ]);

        // Redirect / Response
        return back()->with('success', 'Form submitted successfully!');
    }
}
