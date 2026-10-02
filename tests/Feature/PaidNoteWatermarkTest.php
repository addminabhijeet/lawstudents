<?php

namespace Tests\Feature;

use App\Support\PaidNotePdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;
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
        $this->assertSame(2, substr_count($branded, '(Law Students)'));
        $this->assertStringContainsString('/Subtype /Image', $branded);
        $this->assertStringContainsString('/ca 0.20', $branded);
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

    public function test_viewer_uses_the_same_brand_config_with_escaped_attributes(): void
    {
        config(['file-management.watermark.company_name' => 'Law "Students" & Academy']);
        $html = view('notesstu.company-watermark')->render();

        $this->assertStringContainsString('Law &quot;Students&quot; &amp; Academy', $html);
        $this->assertStringContainsString(config('file-management.watermark.logo'), $html);
        $this->assertStringContainsString('paid-note-watermark.js', $html);
    }
}
