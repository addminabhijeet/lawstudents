<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\CopyCategory;
use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\File;


class FreeNotesController extends Controller
{
    public function __invoke(): View
    {
        $categories = CopyCategory::with([
            'subcategories.copys'
        ])->get();

        // Add default values to prevent undefined variable error
        $filePath = '';
        $studentName = 'Guest';
        $studentEmail = 'guest@example.com';

        return view('copys.copys', compact('categories', 'filePath', 'studentName', 'studentEmail'));
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

        // ===== WATERMARK LOGIC START =====
        $tempDir = storage_path('app/temp');

        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0775, true);
        }

        $tempFile = $tempDir . '/watermarked_' . time() . '.pdf';

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($path);

        $watermarkText = 'Law Students'; // You can customize this

        for ($i = 1; $i <= $pageCount; $i++) {

            $template = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($template);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($template);

            // Watermark
            $pdf->SetFont('Arial', 'B', 20);
            $pdf->SetTextColor(150, 150, 150);

            $pdf->SetXY(0, $size['height'] / 2);
            $pdf->Cell(0, 10, $watermarkText, 0, 1, 'C');
        }

        $pdf->Output($tempFile, 'F');
        // ===== WATERMARK LOGIC END =====

        return response()->download($tempFile, 'note.pdf')->deleteFileAfterSend(true);
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

        // Return a modal-viewer blade instead of raw file
        return view('frontend.viewnotes_modal', [
            'filePath' => asset('storage/' . $file),
            'copy' => $copy,
            'index' => $index,
            'studentName' =>  'Guest',
            'studentEmail' =>  'guest@example.com',
        ]);
    }
}
