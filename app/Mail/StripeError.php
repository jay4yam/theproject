<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StripeError extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;

    /**
     * StripeError constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('jay.ayamee@gmail.com')
                    ->subject('error stripe')
                    ->view('mails.stripeError')->with(['error' => $this->message ]);
    }
}
