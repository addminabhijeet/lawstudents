<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LegalKnowledgeController extends Controller
{
    public function index(): View
    {
        return view('legal-knowledge.legal-knowledge');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'question' => 'required|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
        ]);

        // Handle document upload if provided
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('legal-inquiries', $fileName, 'public');
            $validated['document'] = $fileName;
        }

        // The document is the visitor's own paper: it moves out of the public folder
        // (reachable by URL) to the private disk, under a random name.
        $privateDocument = null;
        if (!empty($validated['document']) && \Storage::disk('public')->exists('legal-inquiries/' . $validated['document'])) {
            $privateDocument = 'legal-inquiries/' . \Illuminate\Support\Str::random(24) . '.' . strtolower(pathinfo($validated['document'], PATHINFO_EXTENSION));
            \Storage::disk('local')->put($privateDocument, \Storage::disk('public')->get('legal-inquiries/' . $validated['document']));
            \Storage::disk('public')->delete('legal-inquiries/' . $validated['document']);
            $validated['document'] = $privateDocument;
        }

        // Store inquiry to database or send email notification
        // This is a placeholder - implement based on your requirements
        \Log::info('Legal Knowledge Inquiry Submitted', $validated);

        // The inquiry used to go nowhere. It is now saved with the contact messages
        // (Admin › Contact Form) and emailed to the site address, as the contact form
        // does. The saved copy stays even if the email cannot be sent.
        $inquiry = \App\Models\ContactForm::create([
            'first_name' => $validated['name'],
            'last_name' => '',
            'phone' => $validated['mobile'],
            'email' => $validated['email'],
            'service_type' => 'Legal Knowledge: ' . $validated['subject'],
            'message' => $validated['question'] . ($privateDocument ? "\n\nDocument (attached to the email): storage/app/private/" . $privateDocument : ''),
            'delete' => 1,
        ]);
        try {
            \Illuminate\Support\Facades\Mail::to(config('mail.from.address'))->send(new \App\Mail\LegalInquiryMail("
                New Legal Knowledge Inquiry:

                Name: {$inquiry->first_name}
                Phone: {$inquiry->phone}
                Email: {$inquiry->email}
                Subject: {$validated['subject']}
                Question: {$validated['question']}
                " . ($privateDocument ? 'Document: attached' : ''), $privateDocument));
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully. We will get back to you soon.');
    }
}
