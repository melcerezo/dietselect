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

    public $chef;

    public $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($planName, $chef, $price)
    {
        //
        $this->planName = $planName;
        $this->chef = $chef;
        $this->price = $price;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('santosmken@outlook.ph')
            ->view('email.order');
    }
}
