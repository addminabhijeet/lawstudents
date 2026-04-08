<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\RuleCategory;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuleController extends Controller
{
    public function __invoke(): View
    {
        $categories = RuleCategory::with([
            'subcategories.rules'
        ])->get();

        return view('rules.rules', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        // Search in rules, categories, and subcategories
        $rules = Rule::with('category', 'subcategory')
            ->where('delete', 1) // only active rules
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
            ->map(function ($rule) {
                return [
                    'title' => $rule->description,
                    'type' => 'Rule',
                    'note_id' => $rule->id,
                    'category_id' => $rule->category_id,
                    'subcategory_id' => $rule->subcategory_id,
                ];
            });

        return response()->json($rules);
    }

    // 📥 DOWNLOAD
    public function viewnote($id, $index = 0)
    {
        $rule = Rule::findOrFail($id);

        if (!isset($rule->pdfs[$index])) {
            abort(404);
        }

        $file = $rule->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->download($path);
    }

    // 👁 VIEW PDF
    public function viewnotes($id, $index = 0)
    {
        $rule = Rule::findOrFail($id);

        if (!isset($rule->pdfs[$index])) {
            abort(404);
        }

        $file = $rule->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->file($path);
    }
}
