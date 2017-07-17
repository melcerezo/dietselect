<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentSuccessChef extends Mailable
{
    use Queueable, SerializesModels;


    public $foodieName;

    public $chefOrderPlans;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($foodieName,$chefOrderPlans)
    {
        $this->foodieName = $foodieName;
        $this->chefOrderPlans = $chefOrderPlans;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.paymentChef');
    }
}
