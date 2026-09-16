<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalKnowledgeCategory;
use App\Models\LegalKnowledgeSubcategory;
use App\Models\LegalKnowledgeNote;
use Illuminate\Http\Request;

// Admin CRUD for the "Legal Knowledge" library feature.
// Mirrors CourseController's rules* methods exactly, kept in its own
// controller so the existing Rules/Acts/Govt-Exam code is never touched.
class LegalKnowledgeLibraryController extends Controller
{
    // ================= CATEGORIES =================

    public function listcategories()
    {
        $categories = LegalKnowledgeCategory::where('delete', 1) // filter visible categories
            ->latest()
            ->paginate(10);

        return view('legal-knowledge-library.categories.list', compact('categories'));
    }

    public function addcategory()
    {
        return view('legal-knowledge-library.categories.add');
    }

    public function storecategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        LegalKnowledgeCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.listlegalknowledgelibrarycategories')
            ->with('success', 'Legal Knowledge category created successfully.');
    }

    public function editcategory($id)
    {
        $categories = LegalKnowledgeCategory::findOrFail($id);
        return view('legal-knowledge-library.categories.edit', compact('categories'));
    }

    public function updatecategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = LegalKnowledgeCategory::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->route('admin.listlegalknowledgelibrarycategories')
            ->with('success', 'Legal Knowledge category updated successfully.');
    }

    public function deletecategoryfile(Request $request, $id)
    {
        $categories = LegalKnowledgeCategory::findOrFail($id);

        // Only mark as deleted
        $categories->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Category deleted successfully.');
    }

    // ================= SUBCATEGORIES =================

    public function listsubcategories()
    {
        $subcategories = LegalKnowledgeSubcategory::with('category')
            ->where('delete', 1) // filter subcategories
            ->latest()
            ->paginate(10);

        return view('legal-knowledge-library.subcategories.list', compact('subcategories'));
    }

    public function addsubcategory()
    {
        $categories = LegalKnowledgeCategory::all();
        return view('legal-knowledge-library.subcategories.add', compact('categories'));
    }

    public function storesubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'legal_knowledge_category_id' => 'required|exists:legal_knowledge_categories,id',
        ]);

        LegalKnowledgeSubcategory::create([
            'name' => $request->name,
            'legal_knowledge_category_id' => $request->legal_knowledge_category_id,
        ]);

        return redirect()->route('admin.listlegalknowledgelibrarysubcategories')
            ->with('success', 'Legal Knowledge subcategory created successfully.');
    }

    public function editsubcategory($id)
    {
        $subcategories = LegalKnowledgeSubcategory::findOrFail($id);
        $categories = LegalKnowledgeCategory::all();
        return view('legal-knowledge-library.subcategories.edit', compact('subcategories', 'categories'));
    }

    public function updatesubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'legal_knowledge_category_id' => 'required|exists:legal_knowledge_categories,id',
        ]);

        $subcategories = LegalKnowledgeSubcategory::findOrFail($id);
        $subcategories->name = $request->name;
        $subcategories->legal_knowledge_category_id = $request->legal_knowledge_category_id;
        $subcategories->save();

        return redirect()->route('admin.listlegalknowledgelibrarysubcategories')
            ->with('success', 'Legal Knowledge subcategory updated successfully.');
    }

    public function deletesubcategoryfile(Request $request, $id)
    {
        $subcategory = LegalKnowledgeSubcategory::findOrFail($id);

        // Only mark as deleted without modifying PDFs
        $subcategory->update(['delete' => 0]);

        return back()->with('success', 'Subcategory deleted successfully.');
    }

    // ================= NOTES (RULES-EQUIVALENT) =================

    public function listnotes()
    {
        $notes = LegalKnowledgeNote::with('category', 'subcategory')->where('delete', 1)->latest()->paginate(10);
        return view('legal-knowledge-library.list', compact('notes'));
    }

    public function addnote()
    {
        $categories = LegalKnowledgeCategory::with('subcategories')->get();

        return view('legal-knowledge-library.add', compact('categories'));
    }

    public function storenote(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:legal_knowledge_categories,id',
            'subcategory_id' => 'required|exists:legal_knowledge_subcategories,id',
            'pdfs' => ['required', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $pdfPaths = [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('legal-knowledge-library', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        LegalKnowledgeNote::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listlegalknowledgelibrary')
            ->with('success', 'Legal Knowledge PDFs uploaded successfully.');
    }

    public function editnote($id)
    {
        $notes = LegalKnowledgeNote::findOrFail($id);

        // Load categories like ADD
        $categories = LegalKnowledgeCategory::with('subcategories')->get();

        return view('legal-knowledge-library.edit', compact('notes', 'categories'));
    }

    public function updatenote(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:legal_knowledge_categories,id',
            'subcategory_id' => 'required|exists:legal_knowledge_subcategories,id',
            'pdfs' => ['nullable', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf', 'max:10240'],
            'description' => ['nullable', 'string'],
        ]);

        $notes = LegalKnowledgeNote::findOrFail($id);

        // Start with existing PDFs
        $pdfPaths = $notes->pdfs ?? [];

        // Add new PDFs if uploaded
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('legal-knowledge-library', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        $notes->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths, // ✅ NO json_encode
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listlegalknowledgelibrary')
            ->with('success', 'Legal Knowledge entry updated successfully.');
    }

    public function notefiledelete(Request $request, $id)
    {
        $notes = LegalKnowledgeNote::findOrFail($id);

        // Soft delete using delete column
        $notes->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Legal Knowledge entry deleted successfully.');
    }
}
