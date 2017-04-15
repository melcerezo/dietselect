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

    public $planName;

    public $amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($foodieName,$amount,$planName)
    {
        $this->foodieName = $foodieName;
        $this->amount = $amount;
        $this->planName = $planName;
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
