<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAddTestimonialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $itemOrder;

    /**
     * SendAddTestimonialsMail constructor.
     * @param Model $itemOrder
     */
    public function __construct($itemOrder)
    {
        $this->itemOrder = $itemOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.addyourtestimonials');
    }
}
