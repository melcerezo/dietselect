<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FreezeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $foodie;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($foodie)
    {
        $this->foodie= $foodie;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.freeze');
    }
}
