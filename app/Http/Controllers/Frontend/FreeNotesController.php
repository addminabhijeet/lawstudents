<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\CopyCategory;
use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\PdfWatermarkService;


class FreeNotesController extends Controller
{
    public function __invoke(): View
    {
        $categories = CopyCategory::with([
            'subcategories.copys'
        ])->where('delete', 1) // Only active categories
            ->get();

        // Default values
        $filePath = '';
        $studentName = 'Guest';
        $studentEmail = 'guest@example.com';

        return view('copys.copys', compact('categories', 'filePath', 'studentName', 'studentEmail'));
    }
    public function copyssearch(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        // Search in copies, categories, and subcategories
        $copys = Copy::with('category', 'subcategory')
            ->where('delete', 1) // Only active copies
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

        return app(PdfWatermarkService::class)->response($file, true, 'note.pdf');
    }

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

        // Use the main Blade view and pass modal-specific variables
        $categories = CopyCategory::with(['subcategories.copys'])->get();

        return view('copys.copys', [
            'categories' => $categories,
            'filePath' => route('frontend.study-pdf.file', ['type' => 'copy', 'id' => $id, 'index' => $index]),
            'studentName' => 'Guest',
            'studentEmail' => 'guest@example.com',
        ]);
    }

    public function viewnoteWatermarked($id, $index = 0)
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

        return app(PdfWatermarkService::class)->response($file);
    }
}
