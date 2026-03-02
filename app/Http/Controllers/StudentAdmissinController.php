<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\Payment;
use App\Models\WhatsappSetting;
use Illuminate\Support\Facades\Mail;
use App\Models\Course;
use Carbon\Carbon;
use App\Mail\StudentOtpMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class StudentAdmissinController extends Controller
{

    public function index()
    {
        $admissions = StudentAdmission::latest()->get();
        return view('admission.list', compact('admissions'));
    }

    public function create()
    {
        $courses = Course::where('status', 1)->get();
        return view('admission.add', compact('courses'));
    }

    public function registeradmsubmit(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:students,email',
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'last_qualification' => 'required|string|max:150',
            'board_university' => 'required|string|max:150',
            'passing_year' => 'required|integer',
            'admission_session' => 'required|string|max:20',
            'admission_status' => 'required|in:pending,approved,rejected',
            'course_ids' => 'nullable|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $student = Student::create([
            'name'     => $data['full_name'],
            'username' => Str::slug($data['full_name']) . rand(100, 999),
            'email'    => $data['email'],
            'password' => '123456',
        ]);

        $data['student_id'] = $student->id;
        $data['course_ids'] = $data['course_ids'] ?? [];

        $admission = StudentAdmission::create($data);

        if ($admission->admission_status === 'approved') {

            $verifiedAdmission = StudentAdmission::where('id', $admission->id)
                ->where('email_verified', true)
                ->where('phone_verified', true)
                ->first();

            if (!$verifiedAdmission) {
                return redirect()->back()
                    ->with('error', 'Email and Phone OTP must be verified before approval.');
            }

            $paymentExists = Payment::where('student_id', $student->id)->exists();

            if (!$paymentExists) {
                Payment::create([
                    'student_id' => $student->id,
                    'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
                    'invoice_label' => 'Admission Fee',
                    'invoice_product' => implode(', ', Course::whereIn('id', $admission->course_ids ?? [])->pluck('title')->toArray()),
                    'issue_date' => now(),
                    'due_date' => now()->addDays(7),
                    'to_name' => $admission->full_name,
                    'to_email' => $admission->email,
                    'to_phone' => $admission->phone,
                    'to_address' => $admission->address_line1,
                    'sub_total' => 0,
                    'grand_total' => 0,
                    'currency' => 'INR',
                    'payment_status' => 'pending',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Admission created successfully.');
    }

    public function sendEmailOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $otp = rand(100000, 999999);

        Session::put('email_otp', $otp);
        Session::put('otp_email', $request->email);

        Mail::to($request->email)->send(new StudentOtpMail($otp));

        return response()->json(['success' => true, 'message' => 'Email OTP sent']);
    }

    public function sendPhoneOtp(Request $request)
    {
        $request->validate(['phone' => 'required']);

        $otp = rand(100000, 999999);

        Session::put('phone_otp', $otp);
        Session::put('otp_phone', $request->phone);

        Http::withHeaders([
            'authorization' => env('FAST2SMS_API_KEY'),
            'accept' => 'application/json',
        ])->post('https://www.fast2sms.com/dev/bulkV2', [
            'route' => 'v3',
            'sender_id' => 'FSTSMS',
            'message' => "Your OTP is $otp",
            'language' => 'english',
            'flash' => 0,
            'numbers' => $request->phone,
        ]);

        return response()->json(['success' => true, 'message' => 'Phone OTP sent']);
    }

    public function verifyEmailOtp(Request $request)
    {
        if ($request->otp == Session::get('email_otp')) {
            Session::put('email_verified', true);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    }

    public function verifyPhoneOtp(Request $request)
    {
        if ($request->otp == Session::get('phone_otp')) {
            Session::put('phone_verified', true);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    }

    public function show($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        return view('admission.show', compact('admission'));
    }

    public function edit($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        return view('admission.edit', compact('admission'));
    }

    public function updateadmsubmit(Request $request, $id)
    {
        $admission = StudentAdmission::findOrFail($id);

        $oldStatus = $admission->admission_status;

        $data = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:students,email,' . $admission->student_id,
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'last_qualification' => 'required|string|max:150',
            'board_university' => 'required|string|max:150',
            'passing_year' => 'required|integer',
            'course_name' => 'required|string|max:150',
            'admission_session' => 'required|string|max:20',
            'admission_status' => 'required|in:pending,approved,rejected',
        ]);

        $admission->update($data);

        if (
            $oldStatus !== 'approved' &&
            $admission->admission_status === 'approved'
        ) {

            $paymentExists = Payment::where('student_id', $admission->student_id)->exists();

            if (!$paymentExists) {
                Payment::create([
                    'student_id' => $admission->student_id,
                    'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
                    'invoice_label' => 'Admission Fee',
                    'invoice_product' => $admission->course_name,
                    'issue_date' => now(),
                    'due_date' => now()->addDays(7),
                    'to_name' => $admission->full_name,
                    'to_email' => $admission->email,
                    'to_phone' => $admission->phone,
                    'to_address' => $admission->address_line1,
                    'sub_total' => 0,
                    'grand_total' => 0,
                    'currency' => 'INR',
                    'payment_status' => 'pending',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Admission updated successfully.');
    }

    public function destroy($id)
    {
        $admission = StudentAdmission::findOrFail($id);
        $admission->delete();

        return redirect()->back()->with('success', 'Admission deleted successfully.');
    }

    public function whatsapp()
    {
        $whatsapp = WhatsappSetting::latest()->get();
        return view('admission.whatsapp', compact('whatsapp'));
    }

    public function updateWhatsapp(Request $request)
    {
        WhatsappSetting::updateOrCreate(
            ['id' => 1],
            [
                'whatsapp_number' => $request->whatsapp_number,
                'pre_message' => $request->pre_message
            ]
        );

        return back()->with('success', 'WhatsApp settings updated');
    }
}
