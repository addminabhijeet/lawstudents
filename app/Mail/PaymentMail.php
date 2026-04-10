<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use SerializesModels;

    public $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('Payment Invoice Details')
            ->view('emails.payment-mail');
    }
}
