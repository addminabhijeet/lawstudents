<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadName;
use App\Http\Controllers\Controller;
use App\Models\Clientele;
use Illuminate\Http\Request;

/**
 * Extracted from CourseController. Handles clientele materials (PDFs/case studies).
 */
class ClienteleController extends Controller
{
    public function listclientele()
    {
        $clienteles = Clientele::where('delete', 0)->paginate(10);
        return view('clientele.list', compact('clienteles'));
    }

    public function addclientele()
    {
        return view('clientele.add');
    }

    public function storeclientele(Request $request)
    {
        $request->validate([
            'pdf' => ['required'],
            'pdf.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('pdf')) {
            foreach ($request->file('pdf') as $file) {
                $originalName = UploadName::safe($file, unique: false);
                $path = $file->storeAs('clientele', $originalName, 'public');

                Clientele::create([
                    'pdfs' => $path,
                    'description' => $request->description,
                ]);
            }
        }

        return redirect()->route('admin.listclientele')
            ->with('success', 'Client PDFs uploaded successfully.');
    }

    public function editclientele($id)
    {
        $clientele = Clientele::findOrFail($id);
        return view('clientele.edit', compact('clientele'));
    }

    public function updateclientele(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable|string',
            'pdfs.*' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $clientele = Clientele::findOrFail($id);

        if ($request->hasFile('pdfs')) {
            $pdfPaths = [];

            foreach ($request->file('pdfs') as $file) {
                $originalName = UploadName::safe($file, unique: false);
                $path = $file->storeAs('clientele', $originalName, 'public');
                $pdfPaths[] = $path;
            }

            $clientele->pdfs = json_encode($pdfPaths);
        }

        $clientele->description = $request->description ?? $clientele->description;
        $clientele->save();

        return redirect()->route('admin.listclientele')
            ->with('success', 'Client PDFs updated successfully.');
    }

    public function clientelefiledelete(Request $request, $id)
    {
        $clientele = Clientele::findOrFail($id);
        $clientele->update(['delete' => 1]);
        return back()->with('success', 'Deleted successfully!');
    }
}
