<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $plan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($plan)
    {
        //
        $this->plan = $plan;
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
