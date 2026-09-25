<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Base controller for the Category → Subcategory → Item pattern.
 * Subclasses override modelClass(), categoryClass(), subcategoryClass(),
 * and the view paths (e.g., category views at 'acts.categories.list').
 */
abstract class CategoryItemController extends Controller
{
    /**
     * Override these in subclasses.
     */
    abstract protected function modelClass(): string;
    abstract protected function categoryClass(): string;
    abstract protected function subcategoryClass(): string;
    abstract protected function viewPrefix(): string; // e.g., 'acts', 'rules', 'copys'

    // ========== Items (Acts, Rules, Copys) ==========

    public function listItems()
    {
        $modelClass = $this->modelClass();
        $items = $modelClass::where('delete', 1)->latest()->paginate(10);
        return view($this->viewPrefix() . '.list', compact('items'));
    }

    public function addItem()
    {
        return view($this->viewPrefix() . '.add');
    }

    public function storeItem(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $modelClass = $this->modelClass();
        $modelClass::create(['name' => $request->name]);
        return redirect()->route('admin.' . $this->viewPrefix() . 's')->with('success', 'Created.');
    }

    public function editItem($id)
    {
        $modelClass = $this->modelClass();
        $item = $modelClass::findOrFail($id);
        return view($this->viewPrefix() . '.edit', compact('item'));
    }

    public function updateItem(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $modelClass = $this->modelClass();
        $modelClass::findOrFail($id)->update(['name' => $request->name]);
        return redirect()->route('admin.' . $this->viewPrefix() . 's')->with('success', 'Updated.');
    }

    public function deleteItemFile(Request $request, $id)
    {
        $modelClass = $this->modelClass();
        $item = $modelClass::findOrFail($id);
        if ($request->has('file_key')) {
            $files = $item->files ?? [];
            unset($files[$request->file_key]);
            $item->update(['files' => $files]);
        }
        return redirect()->back()->with('success', 'File deleted.');
    }

    // ========== Categories ==========

    public function listCategories()
    {
        $categoryClass = $this->categoryClass();
        $categories = $categoryClass::where('delete', 1)->latest()->paginate(10);
        return view($this->viewPrefix() . '.categories.list', compact('categories'));
    }

    public function addCategory()
    {
        return view($this->viewPrefix() . '.categories.add');
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $categoryClass = $this->categoryClass();
        $categoryClass::create(['name' => $request->name]);
        return redirect()->route('admin.list' . ucfirst($this->viewPrefix()) . 'categories')->with('success', 'Created.');
    }

    public function editCategory($id)
    {
        $categoryClass = $this->categoryClass();
        $category = $categoryClass::findOrFail($id);
        return view($this->viewPrefix() . '.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $categoryClass = $this->categoryClass();
        $categoryClass::findOrFail($id)->update(['name' => $request->name]);
        return redirect()->route('admin.list' . ucfirst($this->viewPrefix()) . 'categories')->with('success', 'Updated.');
    }

    public function deleteCategoryFile(Request $request, $id)
    {
        $categoryClass = $this->categoryClass();
        $category = $categoryClass::findOrFail($id);
        if ($request->has('file_key')) {
            $files = $category->files ?? [];
            unset($files[$request->file_key]);
            $category->update(['files' => $files]);
        }
        return redirect()->back()->with('success', 'File deleted.');
    }

    // ========== Subcategories ==========

    public function listSubcategories()
    {
        $subcategoryClass = $this->subcategoryClass();
        $subcategories = $subcategoryClass::where('delete', 1)->latest()->paginate(10);
        return view($this->viewPrefix() . '.subcategories.list', compact('subcategories'));
    }

    public function addSubcategory()
    {
        return view($this->viewPrefix() . '.subcategories.add');
    }

    public function storeSubcategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $subcategoryClass = $this->subcategoryClass();
        $subcategoryClass::create(['name' => $request->name]);
        return redirect()->route('admin.list' . ucfirst($this->viewPrefix()) . 'subcategories')->with('success', 'Created.');
    }

    public function editSubcategory($id)
    {
        $subcategoryClass = $this->subcategoryClass();
        $subcategory = $subcategoryClass::findOrFail($id);
        return view($this->viewPrefix() . '.subcategories.edit', compact('subcategory'));
    }

    public function updateSubcategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $subcategoryClass = $this->subcategoryClass();
        $subcategoryClass::findOrFail($id)->update(['name' => $request->name]);
        return redirect()->route('admin.list' . ucfirst($this->viewPrefix()) . 'subcategories')->with('success', 'Updated.');
    }

    public function deleteSubcategoryFile(Request $request, $id)
    {
        $subcategoryClass = $this->subcategoryClass();
        $subcategory = $subcategoryClass::findOrFail($id);
        if ($request->has('file_key')) {
            $files = $subcategory->files ?? [];
            unset($files[$request->file_key]);
            $subcategory->update(['files' => $files]);
        }
        return redirect()->back()->with('success', 'File deleted.');
    }
}
