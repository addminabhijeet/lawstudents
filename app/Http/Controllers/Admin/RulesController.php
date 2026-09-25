<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadName;
use App\Http\Controllers\Controller;
use App\Models\Rule;
use App\Models\RuleCategory;
use App\Models\RuleSubcategory;
use Illuminate\Http\Request;

/**
 * Extracted from CourseController. Handles Rules, RuleCategories, and RuleSubcategories
 * following the Category → Subcategory → Item pattern.
 */
class RulesController extends Controller
{
    // ========== Rules (Items) ==========

    public function listrules()
    {
        $ruless = Rule::with(['category', 'subcategory'])
            ->where('delete', 1)
            ->latest()
            ->paginate(10);

        return view('rules.list', compact('ruless'));
    }

    public function addrules()
    {
        $categories = RuleCategory::with('subcategories')->get();
        return view('rules.add', compact('categories'));
    }

    public function storerules(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:rule_categories,id',
            'subcategory_id' => 'required|exists:rule_subcategories,id',
            'pdfs' => ['required', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $pdfPaths = [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = UploadName::safe($file);
                $path = $file->storeAs('rules', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        Rule::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listrules')
            ->with('success', 'PDFs uploaded successfully.');
    }

    public function editrules($id)
    {
        $rules = Rule::findOrFail($id);
        $categories = RuleCategory::with('subcategories')->get();
        return view('rules.edit', compact('rules', 'categories'));
    }

    public function updaterules(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:rule_categories,id',
            'subcategory_id' => 'required|exists:rule_subcategories,id',
            'pdfs' => ['nullable', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $rules = Rule::findOrFail($id);
        $pdfPaths = $rules->pdfs ?? [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = UploadName::safe($file);
                $path = $file->storeAs('rules', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        $rules->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listrules')
            ->with('success', 'Rules updated successfully.');
    }

    public function rulesfiledelete(Request $request, $id)
    {
        $rules = Rule::findOrFail($id);
        $rules->update(['delete' => 0]);
        return back()->with('success', 'Rule deleted successfully.');
    }

    // ========== Rule Categories ==========

    public function listrulescategories()
    {
        $categories = RuleCategory::where('delete', 1)->latest()->paginate(10);
        return view('rules.categories.list', compact('categories'));
    }

    public function addrulescategory()
    {
        return view('rules.categories.add');
    }

    public function storerulescategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        RuleCategory::create(['name' => $request->name]);

        return redirect()->route('admin.listrulescategories')
            ->with('success', 'Category created successfully.');
    }

    public function editrulescategory($id)
    {
        $categories = RuleCategory::findOrFail($id);
        return view('rules.categories.edit', compact('categories'));
    }

    public function updaterulescategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $categories = RuleCategory::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->route('admin.listrulescategories')
            ->with('success', 'Category updated successfully.');
    }

    public function deleterulescategoryfile(Request $request, $id)
    {
        $categories = RuleCategory::findOrFail($id);
        $categories->update(['delete' => 0]);
        return back()->with('success', 'Category deleted successfully.');
    }

    // ========== Rule Subcategories ==========

    public function listrulessubcategories()
    {
        $subcategories = RuleSubcategory::with('category')
            ->where('delete', 1)
            ->latest()
            ->paginate(10);

        return view('rules.subcategories.list', compact('subcategories'));
    }

    public function addrulessubcategory()
    {
        $categories = RuleCategory::all();
        return view('rules.subcategories.add', compact('categories'));
    }

    public function storerulessubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rule_category_id' => 'required|exists:rule_categories,id',
        ]);

        RuleSubcategory::create([
            'name' => $request->name,
            'rule_category_id' => $request->rule_category_id,
        ]);

        return redirect()->route('admin.listrulessubcategories')
            ->with('success', 'Rule subcategory created successfully.');
    }

    public function editrulessubcategory($id)
    {
        $subcategories = RuleSubcategory::findOrFail($id);
        $categories = RuleCategory::all();
        return view('rules.subcategories.edit', compact('subcategories', 'categories'));
    }

    public function updaterulessubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rule_category_id' => 'required|exists:rule_categories,id',
        ]);

        $subcategories = RuleSubcategory::findOrFail($id);
        $subcategories->name = $request->name;
        $subcategories->rule_category_id = $request->rule_category_id;
        $subcategories->save();

        return redirect()->route('admin.listrulessubcategories')
            ->with('success', 'Rule subcategory updated successfully.');
    }

    public function deleterulessubcategoryfile(Request $request, $id)
    {
        $categories = RuleSubcategory::findOrFail($id);
        $categories->update(['delete' => 0]);
        return back()->with('success', 'Subcategory deleted successfully.');
    }
}
