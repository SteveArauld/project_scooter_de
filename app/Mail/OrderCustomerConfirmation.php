<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCustomerConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $order)
    {
    }

    public function build()
    {
        return $this->subject('Ihre Bestellbestätigung ' . $this->order['number'])
            ->view('emails.order-customer');
    }
}
