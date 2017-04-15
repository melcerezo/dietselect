<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $planName;

    public $chefName;

    public $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($planName, $chefName, $price)
    {
        //
        $this->planName = $planName;
        $this->chefName = $chefName;
        $this->price = $price;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.order');
    }
}
