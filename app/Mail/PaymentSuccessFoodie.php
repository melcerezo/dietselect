<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentSuccessFoodie extends Mailable
{
    use Queueable, SerializesModels;

    public $amount;

    public $orderPlanNames;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($amount,$orderPlanNames)
    {
        $this->amount = $amount;
        $this->orderPlanNames = $orderPlanNames;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.success');
    }
}
