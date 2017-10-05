<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyOrderMailUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $mailHTML;

    public $price;

    public $time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailHTML,$price,$time)
    {
        $this->mailHTML = $mailHTML;
        $this->price = $price;
        $this->time = $time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.orderUpdate');
    }
}
