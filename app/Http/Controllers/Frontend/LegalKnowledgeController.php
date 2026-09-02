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

        // Store inquiry to database or send email notification
        // This is a placeholder - implement based on your requirements
        \Log::info('Legal Knowledge Inquiry Submitted', $validated);

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully. We will get back to you soon.');
    }
}
