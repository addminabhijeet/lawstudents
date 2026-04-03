<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\ActCategory;
use App\Models\Act;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActController extends Controller
{
    public function __invoke(): View
    {
        $categories = ActCategory::with([
            'subcategories.acts'
        ])->get();

        return view('acts.acts', compact('categories'));
    }

    // 🔍 SEARCH
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $acts = Act::with('category', 'subcategory')
            ->where('description', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($act) {
                return [
                    'title' => $act->description,
                    'type' => 'Act',
                    'note_id' => $act->id,
                    'category_id' => $act->category_id,
                    'subcategory_id' => $act->subcategory_id,
                ];
            });

        return response()->json($acts);
    }

    // 📥 DOWNLOAD
    public function viewnote($id, $index = 0)
    {
        $act = Act::findOrFail($id);

        if (!isset($act->pdfs[$index])) {
            abort(404);
        }

        $file = $act->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->download($path);
    }

    // 👁 VIEW PDF
    public function viewnotes($id, $index = 0)
    {
        $act = Act::findOrFail($id);

        if (!isset($act->pdfs[$index])) {
            abort(404);
        }

        $file = $act->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->file($path);
    }
}
