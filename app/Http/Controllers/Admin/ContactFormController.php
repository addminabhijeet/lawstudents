<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\StudentOtpMail;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Extracted from CourseController. Handles contact form submissions and admin replies.
 */
class ContactFormController extends Controller
{
    public function listcontactform()
    {
        $contact = ContactForm::where('delete', 1)->latest()->paginate(10);
        return view('contact.list', compact('contact'));
    }

    public function viewcontactform($id)
    {
        $contact = ContactForm::findOrFail($id);
        return view('contact.view', compact('contact'));
    }

    /**
     * Send reply to a contact form submission.
     * Fixed: was named sendMail in CourseController but route expected sendcontactmail
     */
    public function sendcontactmail($id)
    {
        $data = ContactForm::findOrFail($id);
        $otp = rand(100000, 999999);
        Mail::to($data->email)->send(new StudentOtpMail($otp));
        return back()->with('success', 'Mail sent successfully!');
    }

    public function deletecontact($id)
    {
        $data = ContactForm::findOrFail($id);
        $data->update(['delete' => 0]);
        return back()->with('success', 'Deleted successfully!');
    }
}
