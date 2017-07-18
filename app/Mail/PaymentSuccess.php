<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $orderPlanNames;

    public $amount;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderPlanNames,$amount)
    {
        $this->orderPlanNames = $orderPlanNames;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.payment');
    }
}
