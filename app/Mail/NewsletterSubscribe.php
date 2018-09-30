<?php

namespace App\Mail;

use App\Models\CouponCode;
use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterSubscribe extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $coupon;

    /**
     * NewsletterSubscribe constructor.
     * @param Newsletter $email
     * @param CouponCode $coupon
     */
    public function __construct(Newsletter $email, CouponCode $coupon)
    {
        $this->email = $email;
        $this->coupon = $coupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.newsletter');
    }
}
