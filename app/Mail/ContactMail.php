<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lines;

    public function __construct($mailData)
    {
        $this->lines = array_values(array_filter(array_map('trim', explode("\n", $mailData))));
    }

    public function build()
    {
        return $this->subject('Contact Form')
            ->view('emails.contact-mail')
            ->with([
                'lines' => $this->lines
            ]);
    }
}
