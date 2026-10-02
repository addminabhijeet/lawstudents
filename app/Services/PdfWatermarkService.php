<?php

namespace App\Services;

use App\Models\Act;
use App\Models\Copy;
use App\Models\CourseNote;
use App\Models\GovtExam;
use App\Models\LegalKnowledgeNote;
use App\Models\PdfWatermarkSetting;
use App\Models\Rule;
use App\Support\PaidNotePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PdfWatermarkService
{
    private ?array $settings = null;

    public function isEnabled(string $file): bool
    {
        if ($this->settings === null) {
            // Existing PDFs stay branded during rollout, before the new migration runs.
            $this->settings = Schema::hasTable('pdf_watermark_settings')
                ? PdfWatermarkSetting::pluck('enabled', 'path_hash')->all()
                : [];
        }

        return (bool) ($this->settings[hash('sha256', $file)] ?? true);
    }

    public function setEnabled(string $file, bool $enabled): void
    {
        PdfWatermarkSetting::updateOrCreate(['path_hash' => hash('sha256', $file)],
            ['file_path' => $file, 'enabled' => $enabled]);
        $this->settings = null;
    }

    public function applyUploadPreference(string $file, Request $request): void
    {
        if ($request->has('show_watermark')) {
            $this->setEnabled($file, $request->boolean('show_watermark'));
        }
    }

    public function resolve(string $type, int $id, int $index = 0, bool $public = false): array
    {
        $models = ['act' => Act::class, 'rule' => Rule::class, 'copy' => Copy::class,
            'govt-exam' => GovtExam::class, 'legal-knowledge' => LegalKnowledgeNote::class,
            'course-note' => CourseNote::class];
        abort_unless(isset($models[$type]) && $index >= 0, 404);
        abort_if($public && $type === 'course-note', 404);
        $document = $models[$type]::findOrFail($id);
        if ($public) {
            abort_unless((int) $document->delete === 1
                && (int) $document->category?->delete === 1
                && (int) $document->subcategory?->delete === 1, 404);
        }
        $file = $type === 'course-note' && $index === 0 ? $document->file_path : ($document->pdfs[$index] ?? null);
        abort_unless(is_string($file) && Storage::disk('public')->exists($file), 404);

        return [$file, $document->title ?: ($document->description ?: basename($file))];
    }

    public function response(string $file, bool $download = false, ?string $filename = null, array $headers = []): BinaryFileResponse
    {
        $source = Storage::disk('public')->path($file);
        abort_unless(is_file($source), 404);
        $enabled = $this->isEnabled($file);
        $served = $enabled ? PaidNotePdf::brandedCopy($source) : $source;
        $headers = array_merge(['Content-Type' => 'application/pdf',
            'Cache-Control' => 'private, no-store, no-cache, must-revalidate',
            'X-Content-Type-Options' => 'nosniff'], $headers);
        $response = $download
            ? response()->download($served, $filename ?: basename($file), $headers)
            : response()->file($served, $headers);

        return $response->deleteFileAfterSend($enabled);
    }
}
