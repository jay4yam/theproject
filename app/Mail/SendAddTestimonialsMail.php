<?php

namespace App\Mail;

use App\Models\ItemOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAddTestimonialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $itemOrder;

    /**
     * SendAddTestimonialsMail constructor.
     * @param ItemOrder $itemOrder
     */
    public function __construct(ItemOrder $itemOrder)
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
