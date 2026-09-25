<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadName;
use App\Http\Controllers\Controller;
use App\Models\Act;
use App\Models\ActCategory;
use App\Models\ActSubcategory;
use Illuminate\Http\Request;

/**
 * Extracted from CourseController. Handles Acts, ActCategories, and ActSubcategories
 * following the Category → Subcategory → Item pattern.
 */
class ActController extends Controller
{
    // ========== Acts (Items) ==========

    public function listacts()
    {
        $actss = Act::with(['category', 'subcategory'])
            ->where('delete', 1)
            ->latest()
            ->paginate(10);

        return view('acts.list', compact('actss'));
    }

    public function addacts()
    {
        $categories = ActCategory::with('subcategories')->get();
        return view('acts.add', compact('categories'));
    }

    public function storeacts(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:act_categories,id',
            'subcategory_id' => 'required|exists:act_subcategories,id',
            'pdfs' => ['required', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $pdfPaths = [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = UploadName::safe($file);
                $path = $file->storeAs('acts', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        Act::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listacts')
            ->with('success', 'PDFs uploaded successfully.');
    }

    public function editacts($id)
    {
        $acts = Act::findOrFail($id);
        $categories = ActCategory::with('subcategories')->get();
        return view('acts.edit', compact('acts', 'categories'));
    }

    public function updateacts(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:act_categories,id',
            'subcategory_id' => 'required|exists:act_subcategories,id',
            'pdfs' => ['nullable', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $acts = Act::findOrFail($id);
        $pdfPaths = $acts->pdfs ?? [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = UploadName::safe($file);
                $path = $file->storeAs('acts', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        $acts->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listacts')
            ->with('success', 'Acts updated successfully.');
    }

    public function actsfiledelete(Request $request, $id)
    {
        $acts = Act::findOrFail($id);
        $acts->update(['delete' => 0]);
        return back()->with('success', 'Act deleted successfully.');
    }

    // ========== Act Categories ==========

    public function listactcategories()
    {
        $categories = ActCategory::where('delete', 1)->latest()->paginate(10);
        return view('acts.categories.list', compact('categories'));
    }

    public function addactcategory()
    {
        return view('acts.categories.add');
    }

    public function storeactcategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        ActCategory::create(['name' => $request->name]);

        return redirect()->route('admin.listactcategories')
            ->with('success', 'Category created successfully.');
    }

    public function editactcategory($id)
    {
        $categories = ActCategory::findOrFail($id);
        return view('acts.categories.edit', compact('categories'));
    }

    public function updateactcategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $categories = ActCategory::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->route('admin.listactcategories')
            ->with('success', 'Category updated successfully.');
    }

    public function deleteactcategoryfile(Request $request, $id)
    {
        $categories = ActCategory::findOrFail($id);
        $categories->update(['delete' => 0]);
        return back()->with('success', 'Category deleted successfully.');
    }

    // ========== Act Subcategories ==========

    public function listactsubcategories()
    {
        $subcategories = ActSubcategory::with('category')
            ->where('delete', 1)
            ->latest()
            ->paginate(10);

        return view('acts.subcategories.list', compact('subcategories'));
    }

    public function addactsubcategory()
    {
        $categories = ActCategory::all();
        return view('acts.subcategories.add', compact('categories'));
    }

    public function storeactsubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'act_category_id' => 'required|exists:act_categories,id',
        ]);

        ActSubcategory::create([
            'name' => $request->name,
            'act_category_id' => $request->act_category_id,
        ]);

        return redirect()->route('admin.listactsubcategories')
            ->with('success', 'Act subcategory created successfully.');
    }

    public function editactsubcategory($id)
    {
        $subcategories = ActSubcategory::findOrFail($id);
        $categories = ActCategory::all();
        return view('acts.subcategories.edit', compact('subcategories', 'categories'));
    }

    public function updateactsubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'act_category_id' => 'required|exists:act_categories,id',
        ]);

        $subcategory = ActSubcategory::findOrFail($id);
        $subcategory->name = $request->name;
        $subcategory->act_category_id = $request->act_category_id;
        $subcategory->save();

        return redirect()->route('admin.listactsubcategories')
            ->with('success', 'Act subcategory updated successfully.');
    }

    public function deleteactsubcategoryfile(Request $request, $id)
    {
        $categories = ActSubcategory::findOrFail($id);
        $categories->update(['delete' => 0]);
        return back()->with('success', 'Subcategory deleted successfully.');
    }

    /**
     * deleteaddfile - legacy method name from CourseController
     * @deprecated Use actsfiledelete instead
     */
    public function deleteaddfile($id, $key)
    {
        $act = Act::findOrFail($id);
        $act->update(['delete' => 0]);
        return back()->with('success', 'Record deleted successfully');
    }
}
