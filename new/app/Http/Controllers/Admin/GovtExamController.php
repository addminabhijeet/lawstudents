<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GovtExamCategory;
use App\Models\GovtExamSubcategory;
use App\Models\GovtExam;
use Illuminate\Http\Request;

// Admin CRUD for the "Centre & State Govt. Examination" feature.
// Mirrors CourseController's rules* methods exactly, kept in its own
// controller so the existing Rules/Acts code is never touched.
class GovtExamController extends Controller
{
    // ================= CATEGORIES =================

    public function listcategories()
    {
        $categories = GovtExamCategory::where('delete', 1) // filter visible categories
            ->latest()
            ->paginate(10);

        return view('govt-exams.categories.list', compact('categories'));
    }

    public function addcategory()
    {
        return view('govt-exams.categories.add');
    }

    public function storecategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        GovtExamCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.listgovtexamcategories')
            ->with('success', 'Govt. Examination category created successfully.');
    }

    public function editcategory($id)
    {
        $categories = GovtExamCategory::findOrFail($id);
        return view('govt-exams.categories.edit', compact('categories'));
    }

    public function updatecategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = GovtExamCategory::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->route('admin.listgovtexamcategories')
            ->with('success', 'Govt. Examination category updated successfully.');
    }

    public function deletecategoryfile(Request $request, $id)
    {
        $categories = GovtExamCategory::findOrFail($id);

        // Only mark as deleted
        $categories->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Category deleted successfully.');
    }

    // ================= SUBCATEGORIES =================

    public function listsubcategories()
    {
        $subcategories = GovtExamSubcategory::with('category')
            ->where('delete', 1) // filter subcategories
            ->latest()
            ->paginate(10);

        return view('govt-exams.subcategories.list', compact('subcategories'));
    }

    public function addsubcategory()
    {
        $categories = GovtExamCategory::all();
        return view('govt-exams.subcategories.add', compact('categories'));
    }

    public function storesubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'govt_exam_category_id' => 'required|exists:govt_exam_categories,id',
        ]);

        GovtExamSubcategory::create([
            'name' => $request->name,
            'govt_exam_category_id' => $request->govt_exam_category_id,
        ]);

        return redirect()->route('admin.listgovtexamsubcategories')
            ->with('success', 'Govt. Examination subcategory created successfully.');
    }

    public function editsubcategory($id)
    {
        $subcategories = GovtExamSubcategory::findOrFail($id);
        $categories = GovtExamCategory::all();
        return view('govt-exams.subcategories.edit', compact('subcategories', 'categories'));
    }

    public function updatesubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'govt_exam_category_id' => 'required|exists:govt_exam_categories,id',
        ]);

        $subcategories = GovtExamSubcategory::findOrFail($id);
        $subcategories->name = $request->name;
        $subcategories->govt_exam_category_id = $request->govt_exam_category_id;
        $subcategories->save();

        return redirect()->route('admin.listgovtexamsubcategories')
            ->with('success', 'Govt. Examination subcategory updated successfully.');
    }

    public function deletesubcategoryfile(Request $request, $id)
    {
        $subcategory = GovtExamSubcategory::findOrFail($id);

        // Only mark as deleted without modifying PDFs
        $subcategory->update(['delete' => 0]);

        return back()->with('success', 'Subcategory deleted successfully.');
    }

    // ================= EXAMS (RULES-EQUIVALENT) =================

    public function listexams()
    {
        $exams = GovtExam::with('category', 'subcategory')->where('delete', 1)->latest()->paginate(10);
        return view('govt-exams.list', compact('exams'));
    }

    public function addexam()
    {
        $categories = GovtExamCategory::with('subcategories')->get();

        return view('govt-exams.add', compact('categories'));
    }

    public function storeexam(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:govt_exam_categories,id',
            'subcategory_id' => 'required|exists:govt_exam_subcategories,id',
            'pdfs' => ['required', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $pdfPaths = [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('govt-exams', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        GovtExam::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listgovtexams')
            ->with('success', 'Govt. Examination PDFs uploaded successfully.');
    }

    public function editexam($id)
    {
        $exams = GovtExam::findOrFail($id);

        // Load categories like ADD
        $categories = GovtExamCategory::with('subcategories')->get();

        return view('govt-exams.edit', compact('exams', 'categories'));
    }

    public function updateexam(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:govt_exam_categories,id',
            'subcategory_id' => 'required|exists:govt_exam_subcategories,id',
            'pdfs' => ['nullable', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf', 'max:10240'],
            'description' => ['nullable', 'string'],
        ]);

        $exams = GovtExam::findOrFail($id);

        // Start with existing PDFs
        $pdfPaths = $exams->pdfs ?? [];

        // Add new PDFs if uploaded
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('govt-exams', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        $exams->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths, // ✅ NO json_encode
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listgovtexams')
            ->with('success', 'Govt. Examination updated successfully.');
    }

    public function examfiledelete(Request $request, $id)
    {
        $exams = GovtExam::findOrFail($id);

        // Soft delete using delete column
        $exams->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Govt. Examination entry deleted successfully.');
    }
}
