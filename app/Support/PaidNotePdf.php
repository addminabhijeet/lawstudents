<?php

namespace App\Support;

use Illuminate\Support\Facades\File;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use Symfony\Component\Process\Process;

class PaidNotePdf extends Fpdi
{
    protected ?int $watermarkResourceId = null;

    public static function brandedCopy(string $source): string
    {
        $directory = storage_path('app/temp');
        File::ensureDirectoryExists($directory);
        $destination = tempnam($directory, 'paid-note-');
        if ($destination === false) {
            throw new \RuntimeException('Unable to create a protected note copy.');
        }

        $normalized = null;
        try {
            $pdf = new self();
            try {
                $pageCount = $pdf->setSourceFile($source);
            } catch (CrossReferenceException $exception) {
                if ($exception->getCode() !== CrossReferenceException::COMPRESSED_XREF) throw $exception;
                $normalized = tempnam($directory, 'pdf-normalized-');
                if ($normalized === false) throw new \RuntimeException('Unable to prepare this PDF.');
                $binary = config('file-management.watermark.qpdf_binary');
                (new Process([$binary, '--warning-exit-0', '--object-streams=disable', '--stream-data=preserve', $source, $normalized]))
                    ->setTimeout(60)->mustRun();
                $pdf = new self();
                $pageCount = $pdf->setSourceFile($normalized);
            }
            for ($page = 1; $page <= $pageCount; $page++) {
                $template = $pdf->importPage($page);
                $size = $pdf->getTemplateSize($template);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($template);
                $pdf->addCompanyWatermark($size['width'], $size['height']);
            }
            $pdf->Output('F', $destination);

            return $destination;
        } catch (\Throwable $exception) {
            File::delete($destination);
            throw $exception;
        } finally {
            if ($normalized) File::delete($normalized);
        }
    }

    public function addCompanyWatermark(float $width, float $height): void
    {
        $this->PDFVersion = max($this->PDFVersion, '1.4');
        $logo = public_path(config('file-management.watermark.logo'));
        $name = config('file-management.watermark.company_name');
        $logoWidth = 16;
        $logoSize = is_file($logo) ? getimagesize($logo) : false;
        $logoHeight = $logoSize ? $logoWidth * $logoSize[1] / $logoSize[0] : 0;

        // Scope transparency to the branding so the imported note remains unchanged.
        $this->_out('q /CompanyWatermark gs');
        $this->SetTextColor(100, 100, 100);
        for ($row = 0, $y = 3; $y < $height; $row++, $y += 18) {
            for ($x = $row % 2 === 0 ? 0 : -16; $x < $width; $x += 32) {
                $center = $x + 16;
                if ($logoSize) {
                    $this->Image($logo, $center - $logoWidth / 2, $y, $logoWidth);
                }
                $this->SetFont('Arial', 'B', 5);
                $this->Text($center - $this->GetStringWidth($name) / 2, $y + $logoHeight + 2, $name);
            }
        }
        $this->_out('Q');
    }

    protected function _putresources()
    {
        $this->_newobj();
        $this->watermarkResourceId = $this->n;
        $opacity = max(0, min(1, (float) config('file-management.watermark.paid_opacity', 0.20)));
        $this->_put(sprintf('<< /Type /ExtGState /ca %.2F /CA %.2F /BM /Normal >>', $opacity, $opacity));
        $this->_put('endobj');
        parent::_putresources();
    }

    protected function _putresourcedict()
    {
        parent::_putresourcedict();
        $this->_put('/ExtGState << /CompanyWatermark '.$this->watermarkResourceId.' 0 R >>');
    }
}
