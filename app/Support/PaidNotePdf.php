<?php

namespace App\Support;

use setasign\Fpdi\Fpdi;

class PaidNotePdf extends Fpdi
{
    protected ?int $watermarkResourceId = null;

    public function addCompanyWatermark(float $width, float $height): void
    {
        $this->PDFVersion = max($this->PDFVersion, '1.4');
        $logo = public_path(config('file-management.watermark.logo'));
        $name = config('file-management.watermark.company_name');
        $logoWidth = min(70, $width * 0.45, $height * 0.7);
        $logoSize = is_file($logo) ? getimagesize($logo) : false;
        $logoHeight = $logoSize ? $logoWidth * $logoSize[1] / $logoSize[0] : 0;

        // Scope transparency to the branding so the imported note remains unchanged.
        $this->_out('q /CompanyWatermark gs');
        if ($logoSize) {
            $this->Image($logo, ($width - $logoWidth) / 2, ($height - $logoHeight) / 2 - 4, $logoWidth);
        }

        $this->SetFont('Arial', 'B', 20);
        $textWidth = $this->GetStringWidth($name);
        if ($textWidth > $width * 0.7) {
            $this->SetFont('Arial', 'B', 20 * $width * 0.7 / $textWidth);
        }
        $this->SetTextColor(100, 100, 100);
        $this->Text(($width - $this->GetStringWidth($name)) / 2, ($height + $logoHeight) / 2 + 5, $name);
        $this->_out('Q');
    }

    protected function _putresources()
    {
        $this->_newobj();
        $this->watermarkResourceId = $this->n;
        $this->_put('<< /Type /ExtGState /ca 0.20 /CA 0.20 /BM /Normal >>');
        $this->_put('endobj');
        parent::_putresources();
    }

    protected function _putresourcedict()
    {
        parent::_putresourcedict();
        $this->_put('/ExtGState << /CompanyWatermark '.$this->watermarkResourceId.' 0 R >>');
    }
}
