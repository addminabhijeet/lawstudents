<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadName;
use App\Http\Controllers\Controller;
use App\Models\Copy;
use App\Models\CopyCategory;
use App\Models\CopySubcategory;
use Illuminate\Http\Request;

/**
 * Extracted from CourseController. Handles Copys, CopyCategories, and CopySubcategories
 * following the Category → Subcategory → Item pattern.
 */
class CopyController extends Controller
{
    // ========== Copys (Items) ==========

    public function listcopys()
    {
        $copys = Copy::with(['category', 'subcategory'])
            ->where('delete', 1)
            ->latest()
            ->paginate(10);

        return view('copys.list', compact('copys'));
    }

    public function addcopys()
    {
        $categories = CopyCategory::with('subcategories')->get();
        return view('copys.add', compact('categories'));
    }

    public function storecopys(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:copy_categories,id',
            'subcategory_id' => 'required|exists:copy_subcategories,id',
            'pdfs' => ['required', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $pdfPaths = [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = UploadName::safe($file);
                $path = $file->storeAs('copys', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        Copy::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listcopys')
            ->with('success', 'PDFs uploaded successfully.');
    }

    public function editcopys($id)
    {
        $copys = Copy::findOrFail($id);
        $categories = CopyCategory::with('subcategories')->get();
        return view('copys.edit', compact('copys', 'categories'));
    }

    public function updatecopys(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:copy_categories,id',
            'subcategory_id' => 'required|exists:copy_subcategories,id',
            'pdfs' => ['nullable', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $copys = Copy::findOrFail($id);
        $pdfPaths = $copys->pdfs ?? [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = UploadName::safe($file);
                $path = $file->storeAs('copys', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        $copys->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listcopys')
            ->with('success', 'Copys updated successfully.');
    }

    public function copysfiledelete(Request $request, $id)
    {
        $copys = Copy::findOrFail($id);
        $copys->update(['delete' => 0]);
        return back()->with('success', 'Copy deleted successfully.');
    }

    // ========== Copy Categories ==========

    public function listcopyscategories()
    {
        $categories = CopyCategory::where('delete', 1)->latest()->paginate(10);
        return view('copys.categories.list', compact('categories'));
    }

    public function addcopyscategory()
    {
        return view('copys.categories.add');
    }

    public function storecopyscategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        CopyCategory::create(['name' => $request->name]);

        return redirect()->route('admin.listcopyscategories')
            ->with('success', 'Category created successfully.');
    }

    public function editcopyscategory($id)
    {
        $categories = CopyCategory::findOrFail($id);
        return view('copys.categories.edit', compact('categories'));
    }

    public function updatecopyscategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $categories = CopyCategory::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->route('admin.listcopyscategories')
            ->with('success', 'Category updated successfully.');
    }

    public function deletecopyscategoryfile(Request $request, $id)
    {
        $categories = CopyCategory::findOrFail($id);
        $categories->update(['delete' => 0]);
        return back()->with('success', 'Category deleted successfully.');
    }

    // ========== Copy Subcategories ==========

    public function listcopyssubcategories()
    {
        $subcategories = CopySubcategory::with('category')
            ->where('delete', 1)
            ->latest()
            ->paginate(10);

        return view('copys.subcategories.list', compact('subcategories'));
    }

    public function addcopyssubcategory()
    {
        $categories = CopyCategory::all();
        return view('copys.subcategories.add', compact('categories'));
    }

    public function storecopyssubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'copy_category_id' => 'required|exists:copy_categories,id',
        ]);

        CopySubcategory::create([
            'name' => $request->name,
            'copy_category_id' => $request->copy_category_id,
        ]);

        return redirect()->route('admin.listcopyssubcategories')
            ->with('success', 'Copy subcategory created successfully.');
    }

    public function editcopyssubcategory($id)
    {
        $subcategories = CopySubcategory::findOrFail($id);
        $categories = CopyCategory::all();
        return view('copys.subcategories.edit', compact('subcategories', 'categories'));
    }

    public function updatecopyssubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'copy_category_id' => 'required|exists:copy_categories,id',
        ]);

        $subcategories = CopySubcategory::findOrFail($id);
        $subcategories->name = $request->name;
        $subcategories->copy_category_id = $request->copy_category_id;
        $subcategories->save();

        return redirect()->route('admin.listcopyssubcategories')
            ->with('success', 'Copy subcategory updated successfully.');
    }

    public function deletecopyssubcategoryfile(Request $request, $id)
    {
        $categories = CopySubcategory::findOrFail($id);
        $categories->update(['delete' => 0]);
        return back()->with('success', 'Subcategory deleted successfully.');
    }
}
