<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

/**
 * A Legal Knowledge inquiry for the team: the same email layout as the contact
 * form (emails.contact-mail), with the visitor's document attached when there is one.
 */
class LegalInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lines;

    public function __construct(string $mailData, public ?string $documentPath = null)
    {
        $this->lines = array_values(array_filter(array_map('trim', explode("\n", $mailData))));
    }

    public function build()
    {
        $mail = $this->subject('Legal Knowledge Inquiry')
            ->view('emails.contact-mail')
            ->with(['lines' => $this->lines]);

        // The document is kept on the private disk (storage/app/private).
        if ($this->documentPath && Storage::disk('local')->exists($this->documentPath)) {
            $mail->attachFromStorageDisk('local', $this->documentPath);
        }

        return $mail;
    }
}
