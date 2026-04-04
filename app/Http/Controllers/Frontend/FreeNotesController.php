<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\CopyCategory;
use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FreeNotesController extends Controller
{
    public function __invoke(): View
    {
        $categories = CopyCategory::with([
            'subcategories.copys'
        ])->get();

        return view('copys.copys', compact('categories'));
    }

    // 🔍 SEARCH
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $copys = Copy::with('category', 'subcategory')
            ->where('description', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($copy) {
                return [
                    'title' => $copy->description,
                    'type' => 'Copy',
                    'note_id' => $copy->id,
                    'category_id' => $copy->category_id,
                    'subcategory_id' => $copy->subcategory_id,
                ];
            });

        return response()->json($copys);
    }

    // 📥 DOWNLOAD
    public function viewnote($id, $index = 0)
    {
        $copy = Copy::findOrFail($id);

        if (!isset($copy->pdfs[$index])) {
            abort(404);
        }

        $file = $copy->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->download($path);
    }

    // 👁 VIEW PDF
    public function viewnotes($id, $index = 0)
    {
        $copy = Copy::findOrFail($id);

        if (!isset($copy->pdfs[$index])) {
            abort(404);
        }

        $file = $copy->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->file($path);
    }
}
