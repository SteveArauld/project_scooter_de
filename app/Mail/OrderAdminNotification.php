<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $order)
    {
    }

    public function build()
    {
        return $this->subject('Neue Bestellung ' . $this->order['number'])
            ->replyTo($this->order['customer']['email'])
            ->view('emails.order-admin');
    }
}
