<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\GovtExamCategory;
use App\Models\GovtExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GovtExamController extends Controller
{
    public function __invoke(): View
    {
        $categories = GovtExamCategory::with([
            'subcategories.exams'
        ])->get();

        return view('govt-exams.govt-exams', compact('categories'));
    }

    public function govtexamssearch(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        // Search in exams, categories, and subcategories
        $exams = GovtExam::with('category', 'subcategory')
            ->where('delete', 1) // only active exams
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
            ->map(function ($exam) {
                return [
                    'title' => $exam->description,
                    'type' => 'GovtExam',
                    'note_id' => $exam->id,
                    'category_id' => $exam->category_id,
                    'subcategory_id' => $exam->subcategory_id,
                ];
            });

        return response()->json($exams);
    }

    // 📥 DOWNLOAD
    public function viewnote($id, $index = 0)
    {
        $exam = GovtExam::findOrFail($id);

        if (!isset($exam->pdfs[$index])) {
            abort(404);
        }

        $file = $exam->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->download($path);
    }

    // 👁 VIEW PDF
    public function viewnotes($id, $index = 0)
    {
        $exam = GovtExam::findOrFail($id);

        if (!isset($exam->pdfs[$index])) {
            abort(404);
        }

        $file = $exam->pdfs[$index];

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($file);

        return response()->file($path);
    }
}
