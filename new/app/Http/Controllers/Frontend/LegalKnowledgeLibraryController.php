<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\LegalKnowledgeCategory;
use App\Models\LegalKnowledgeNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Rules-style "Legal Knowledge" library (categories/subcategories/PDFs).
// Kept separate from LegalKnowledgeController, which powers the existing
// legal-knowledge inquiry form and its routes/view — that stays untouched.
class LegalKnowledgeLibraryController extends Controller
{
    public function __invoke(): View
    {
        $categories = LegalKnowledgeCategory::with([
            'subcategories.notes'
        ])->get();

        return view('legal-knowledge-library.legal-knowledge-library', compact('categories'));
    }

    public function legalknowledgelibrarysearch(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        // Search in notes, categories, and subcategories
        $notes = LegalKnowledgeNote::with('category', 'subcategory')
            ->where('delete', 1) // only active notes
            ->where(function ($q) use ($query) {
                $q->where('description', 'LIKE', "%{$query}%")
                    ->orWhereHas('category', function ($q2) use ($query) {
                        $q2->where('delete', 1)
                            ->where('name', 'LIKE', "%{$query}%");
                    })
                    ->orWhereHas('subcategory', function ($q3) use ($query) {
                        $q3->where('delete', 1)
                            ->where('name', 'LIKE', "%{$query}%");
                    });
            })
            ->limit(10)
            ->get()
            ->map(function ($note) {
                return [
                    'title' => $note->description,
                    'type' => 'LegalKnowledge',
                    'note_id' => $note->id,
                    'category_id' => $note->category_id,
                    'subcategory_id' => $note->subcategory_id,
                ];
            });

        return response()->json($notes);
    }

    // 📥 DOWNLOAD
    public function viewnote($id, $index = 0)
    {
        $note = LegalKnowledgeNote::findOrFail($id);

        if (!isset($note->pdfs[$index])) {
            abort(404);
        }

        $file = $note->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->download($path);
    }

    // 👁 VIEW PDF
    public function viewnotes($id, $index = 0)
    {
        $note = LegalKnowledgeNote::findOrFail($id);

        if (!isset($note->pdfs[$index])) {
            abort(404);
        }

        $file = $note->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->file($path);
    }
}
