<?php

namespace Tests\Feature;

use App\Support\PaidNotePdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;
use Tests\TestCase;

class PaidNoteWatermarkTest extends TestCase
{
    public function test_branding_preserves_content_page_count_and_mixed_page_sizes(): void
    {
        $source = new Fpdi();
        $source->SetCompression(false);
        foreach (['P', 'L'] as $orientation) {
            $source->AddPage($orientation, 'A4');
            $source->SetFont('Arial', '', 12);
            $source->Text(15, 20, 'Original note content '.$orientation);
        }
        $original = $source->Output('S');
        $pdf = new PaidNotePdf();
        $pdf->SetCompression(false);
        $pageCount = $pdf->setSourceFile(StreamReader::createByString($original));

        for ($page = 1; $page <= $pageCount; $page++) {
            $template = $pdf->importPage($page);
            $size = $pdf->getTemplateSize($template);
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($template);
            $pdf->addCompanyWatermark($size['width'], $size['height']);
        }
        $branded = $pdf->Output('S');

        $this->assertStringContainsString('Original note content P', $branded);
        $this->assertStringContainsString('Original note content L', $branded);
        $this->assertGreaterThan(150, substr_count($branded, '(Law Students)'));
        $this->assertStringNotContainsString('(law.norloxsolutionscrm.com)', $branded);
        $this->assertStringContainsString('/Subtype /Image', $branded);
        $this->assertStringContainsString('/ca 0.10', $branded);
        $this->assertStringContainsString('/CompanyWatermark', $branded);

        $reader = new Fpdi();
        $this->assertSame(2, $reader->setSourceFile(StreamReader::createByString($branded)));
        foreach ([1 => [210, 297], 2 => [297, 210]] as $page => [$width, $height]) {
            $size = $reader->getTemplateSize($reader->importPage($page));
            $this->assertEqualsWithDelta($width, $size['width'], 0.1);
            $this->assertEqualsWithDelta($height, $size['height'], 0.1);
        }
        $this->assertSame($original, $source->Output('S'));
    }

    public function test_company_name_still_appears_when_logo_is_unavailable(): void
    {
        config(['file-management.watermark.logo' => 'missing-company-logo.png']);
        $pdf = new PaidNotePdf();
        $pdf->SetCompression(false);
        $pdf->AddPage();
        $pdf->addCompanyWatermark(210, 297);

        $this->assertStringContainsString('(Law Students)', $pdf->Output('S'));
    }

    public function test_viewers_load_print_protection_with_cache_busting(): void
    {
        $html = view('notesstu.company-watermark')->render();

        $this->assertStringContainsString('paid-note-protection.css?v=', $html);
        $this->assertStringContainsString('paid-note-protection.js?v=', $html);
    }

    public function test_concurrent_copies_use_distinct_files_and_preserve_the_source(): void
    {
        $source = tempnam(sys_get_temp_dir(), 'note-source-');
        $first = $second = null;
        try {
            $pdf = new Fpdi();
            $pdf->AddPage();
            $pdf->Output('F', $source);
            $hash = hash_file('sha256', $source);
            $first = PaidNotePdf::brandedCopy($source);
            $second = PaidNotePdf::brandedCopy($source);

            $this->assertNotSame($first, $second);
            $this->assertNotSame($source, $first);
            $this->assertFileExists($first);
            $this->assertFileExists($second);
            $this->assertSame($hash, hash_file('sha256', $source));
        } finally {
            foreach ([$source, $first, $second] as $file) {
                if ($file && is_file($file)) {
                    unlink($file);
                }
            }
        }
    }

    public function test_compressed_object_streams_are_watermarked_without_changing_the_upload(): void
    {
        $binary = config('file-management.watermark.qpdf_binary');
        if (!is_file($binary) && !(new ExecutableFinder())->find($binary)) $this->markTestSkipped('QPDF is not installed.');
        $source = tempnam(sys_get_temp_dir(), 'note-plain-');
        $compressed = tempnam(sys_get_temp_dir(), 'note-compressed-');
        $branded = null;
        try {
            $pdf = new Fpdi();
            $pdf->AddPage('L', 'A4');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Text(20, 20, 'Compressed original content');
            $pdf->Output('F', $source);
            (new Process([$binary, '--object-streams=generate', $source, $compressed]))->mustRun();
            $hash = hash_file('sha256', $compressed);
            $branded = PaidNotePdf::brandedCopy($compressed);
            $reader = new Fpdi();
            $this->assertSame(1, $reader->setSourceFile($branded));
            $size = $reader->getTemplateSize($reader->importPage(1));
            $this->assertEqualsWithDelta(297, $size['width'], 0.1);
            $this->assertEqualsWithDelta(210, $size['height'], 0.1);
            $this->assertSame($hash, hash_file('sha256', $compressed));
            $this->assertStringContainsString('/CompanyWatermark', file_get_contents($branded));
        } finally {
            foreach ([$source, $compressed, $branded] as $file) {
                if ($file && is_file($file)) unlink($file);
            }
        }
    }
}
