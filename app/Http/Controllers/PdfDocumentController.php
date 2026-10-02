<?php

namespace App\Http\Controllers;

use App\Services\PdfWatermarkService;
use Illuminate\Http\Request;

class PdfDocumentController extends Controller
{
    public function viewer(PdfWatermarkService $watermarks, string $type, int $id, int $index = 0)
    {
        [$file, $title] = $watermarks->resolve($type, $id, $index, true);

        return response()->view('pdfs.viewer', ['title' => $title,
            'fileUrl' => route('frontend.study-pdf.file', compact('type', 'id', 'index'))])
            ->header('Cache-Control', 'private, no-store');
    }

    public function file(Request $request, PdfWatermarkService $watermarks, string $type, int $id, int $index = 0)
    {
        [$file] = $watermarks->resolve($type, $id, $index, true);
        if ($request->boolean('download')) {
            abort_unless(auth()->check(), 403);
        }

        return $watermarks->response($file, $request->boolean('download'));
    }

    public function adminFile(Request $request, PdfWatermarkService $watermarks, string $type, int $id, int $index = 0)
    {
        [$file] = $watermarks->resolve($type, $id, $index);

        return $watermarks->response($file, $request->boolean('download'));
    }

    public function update(Request $request, PdfWatermarkService $watermarks)
    {
        $data = $request->validate(['type' => 'required|string', 'id' => 'required|integer|min:1',
            'index' => 'required|integer|min:0', 'enabled' => 'required|boolean']);
        [$file] = $watermarks->resolve($data['type'], $data['id'], $data['index']);
        $watermarks->setEnabled($file, $request->boolean('enabled'));

        return response()->json(['enabled' => $watermarks->isEnabled($file)]);
    }
}
