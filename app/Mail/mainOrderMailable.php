<?php

namespace App\Mail;

use App\Models\MainOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mainOrderMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $mainOrder;

    /**
     * Create a new message instance.
     * @param  MainOrder  $mainOrder
     */
    public function __construct(MainOrder $mainOrder)
    {
        $this->mainOrder = $mainOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.newOrder')
            ->subject('Confirmation de commande')
            ->to($this->mainOrder->user->email)
            ->cc('jay.ayamee@gmail.com')
            ->with(['mainOrder' => $this->mainOrder]);
    }
}
