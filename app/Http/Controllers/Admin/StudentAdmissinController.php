<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Declaration;
use App\Models\WhatsappSetting;
use Illuminate\Support\Facades\Mail;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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

    public function addadmission()
    {
        $courses = Course::where('status', 1)->get();
        $declaration = Declaration::first();

        $year = date('Y');

        $lastAdmission = StudentAdmission::where('admno', 'like', 'LAW' . $year . '%')
            ->orderBy('admno', 'desc')
            ->first();

        if ($lastAdmission) {
            $lastNumber = intval(substr($lastAdmission->admno, -6));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $admno = 'LAW' . $year . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        return view('admission.add', compact('courses', 'declaration', 'admno'));
    }

    public function registeradmsubmit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', 'unique:students,email'],
            'phone' => ['required', 'string', 'max:20'],
            'address_line1' => ['required', 'string', 'max:255'],
            'admission_status' => ['required', 'in:pending,approved,rejected'],
            'course_ids' => ['nullable', 'array'],
            'course_ids.*' => ['exists:courses,id'],
        ]);

        return DB::transaction(function () use ($validated, $request) {


            $student = Student::create([
                'name'     => $validated['full_name'],
                'username' => Str::slug($validated['full_name']) . rand(100, 999),
                'email'    => $validated['email'],
                'password' => Hash::make(Str::random(10)),
            ]);


            if ($validated['admission_status'] === 'approved') {

                if (
                    !$request->boolean('email_verified') ||
                    !$request->boolean('phone_verified')
                ) {
                    abort(422, 'Email and Phone OTP must be verified before approval.');
                }
            }


            $courses = Course::whereIn('id', $validated['course_ids'] ?? [])->get();
            $subTotal = $courses->sum('price');

            $discountPercent = $request->input('discount_percent', 0);
            $discountAmount  = ($subTotal * $discountPercent) / 100;
            $grandTotal      = $subTotal - $discountAmount;


            $admission = StudentAdmission::create([
                'student_id'      => $student->id,
                'full_name'       => $validated['full_name'],
                'email'           => $validated['email'],
                'phone'           => $validated['phone'],
                'address_line1'   => $validated['address_line1'],
                'admission_status' => $validated['admission_status'],
                'course_ids'      => $validated['course_ids'] ?? [],
                'email_verified'  => $request->boolean('email_verified'),
                'phone_verified'  => $request->boolean('phone_verified'),
            ]);


            if ($admission->admission_status === 'approved') {

                Payment::create([
                    'student_id'     => $student->id,
                    'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
                    'invoice_label'  => 'Admission Fee',
                    'invoice_product' => $courses->pluck('title')->implode(', '),
                    'issue_date'     => now(),
                    'due_date'       => now()->addDays(7),
                    'to_name'        => $admission->full_name,
                    'to_email'       => $admission->email,
                    'to_phone'       => $admission->phone,
                    'to_address'     => $admission->address_line1,
                    'sub_total'      => $subTotal,
                    'discount'       => $discountAmount,
                    'grand_total'    => $grandTotal,
                    'currency'       => 'INR',
                    'payment_status' => 'pending',
                ]);
            }

            return redirect()
                ->back()
                ->with('success', 'Admission created successfully.');
        });
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

    public function showadmission($id)
    {
        $courses = Course::where('status', 1)->get();
        $admission = StudentAdmission::findOrFail($id);
        return view('admission.view', compact('courses', 'admission'));
    }

    public function edit($id)
    {
        $courses = Course::where('status', 1)->get();
        $admission = StudentAdmission::findOrFail($id);

        // Generate admno if empty
        if (empty($admission->admno)) {

            $year = date('Y');

            $lastAdmission = StudentAdmission::where('admno', 'like', 'LAW' . $year . '%')
                ->orderBy('admno', 'desc')
                ->first();

            if ($lastAdmission) {
                $lastNumber = intval(substr($lastAdmission->admno, -6));
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }

            $admno = 'LAW' . $year . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

            $admission->admno = $admno;
            $admission->save();
        }

        return view('admission.edit', compact('courses', 'admission'));
    }

    public function updateadmsubmit(Request $request, $id)
    {
        $admission = StudentAdmission::findOrFail($id);

        // Generate admno if empty
        if (empty($admission->admno)) {

            $year = date('Y');

            $lastAdmission = StudentAdmission::where('admno', 'like', 'LAW' . $year . '%')
                ->orderBy('admno', 'desc')
                ->first();

            if ($lastAdmission) {
                $lastNumber = intval(substr($lastAdmission->admno, -6));
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }

            $admission->admno = 'LAW' . $year . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        }

        $oldStatus = $admission->admission_status;

        // Validation
        $data = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:20',
            'father_name' => 'nullable|string|max:150',

            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',

            'course_ids' => 'nullable|array',

            'admission_status' => 'required|in:pending,approved,rejected',

            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        if ($request->has('course_ids')) {
            $data['course_ids'] = $request->course_ids;
        }


        if ($request->hasFile('photo')) {

            if ($admission->photo && file_exists(storage_path('app/public/' . $admission->photo))) {
                unlink(storage_path('app/public/' . $admission->photo));
            }

            $photoPath = $request->file('photo')->store('students/photos', 'public');

            $data['photo'] = $photoPath;
        }

        if ($request->hasFile('signature')) {

            if ($admission->signature && file_exists(storage_path('app/public/' . $admission->signature))) {
                unlink(storage_path('app/public/' . $admission->signature));
            }

            $signPath = $request->file('signature')->store('students/signatures', 'public');

            $data['signature'] = $signPath;
        }

        $admission->update($data);

        if (
            $oldStatus !== 'approved' &&
            $admission->admission_status === 'approved'
        ) {

            $paymentExists = Payment::where('student_id', $admission->student_id)->exists();

            $year = date('Y');

            $lastInvoice = Payment::where('invoice_number', 'like', 'INV' . $year . '%')
                ->orderBy('id', 'desc')
                ->first();

            if ($lastInvoice) {
                $lastNumber = intval(substr($lastInvoice->invoice_number, 7));
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }

            $invoiceNumber = 'INV' . $year . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

            $subtotal = 0;
            $courseTitles = [];

            if ($admission->course_ids) {

                $courses = Course::whereIn('id', $admission->course_ids)->get();

                foreach ($courses as $course) {
                    $subtotal += $course->price;
                    $courseTitles[] = $course->title;
                }
            }

            if (!$paymentExists) {

                Payment::create([
                    'student_id' => $admission->student_id,

                    'invoice_number' => $invoiceNumber,
                    'invoice_label' => 'Admission Fee',
                    'invoice_product' => implode(', ', $courseTitles),

                    'issue_date' => now(),
                    'due_date' => now()->addDays(7),

                    'to_name' => $admission->full_name,
                    'to_email' => $admission->email,
                    'to_phone' => $admission->phone,
                    'to_address' => $admission->address_line1,

                    'sub_total' => $subtotal,
                    'grand_total' => $subtotal,

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
