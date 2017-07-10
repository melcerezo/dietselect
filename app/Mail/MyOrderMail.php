<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailHTML;

    public $price;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailHTML,$price)
    {
        //
        $this->mailHTML = $mailHTML;
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
