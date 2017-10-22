<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelSuccessFoodie extends Mailable
{
    use Queueable, SerializesModels;

    public $chefName;

    public $planName;

    public $time;

    public $mailMess;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($chefName,$planName,$time,$mailMess)
    {
        $this->chefName = $chefName;
        $this->planName = $planName;
        $this->time = $time;
        $this->mailMess = $mailMess;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.cancelFoodie');
    }
}
