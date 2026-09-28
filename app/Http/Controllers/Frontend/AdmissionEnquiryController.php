<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdmissionLead;
use App\Models\Course;
use App\Services\ActivityTracker;
use Illuminate\Http\Request;

class AdmissionEnquiryController extends Controller
{
    public function create()
    {
        return view('activity.enquiry', ['courses' => Course::where('status', 1)->orderBy('title')->pluck('title')]);
    }

    public function store(Request $request, ActivityTracker $tracker)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => ['nullable', 'required_without:email', 'string', 'max:30', 'regex:/^\+?[0-9 ()-]{7,30}$/'],
            'email' => 'nullable|required_without:phone|email|max:150',
            'course_interest' => 'nullable|string|max:150',
            'consent' => 'accepted',
            'company_website' => 'nullable|max:0',
        ]);
        $visitor = $tracker->context($request)['visitor_id'];
        // A refresh or double click should not create a second enquiry with the same details.
        $lead = AdmissionLead::where('visitor_id', $visitor)->where('name', $data['name'])
            ->where('email', $data['email'] ?? null)->where('phone', $data['phone'] ?? null)
            ->where('course_interest', $data['course_interest'] ?? null)->where('submitted_at', '>=', now()->subMinutes(10))->first();
        if (!$lead) {
            $lead = AdmissionLead::create([
                'visitor_id' => $visitor, 'name' => $data['name'], 'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null, 'course_interest' => $data['course_interest'] ?? null,
                'student_id' => auth('student')->id(), 'source' => 'admission_enquiry',
                'consent_at' => now(), 'submitted_at' => now(),
            ]);
        }
        return redirect()->route('frontend.enquiry')->with('enquiry_received', $lead->id);
    }
}
