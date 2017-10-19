<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelFoodieSideChef extends Mailable
{
    use Queueable, SerializesModels;

    public $foodieName;

    public $planName;

    public $mailMess;

    public $time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($foodieName,$planName,$mailMess,$time)
    {
        $this->foodieName = $foodieName;
        $this->planName = $planName;
        $this->mailMess = $mailMess;
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
            ->view('email.cancelFoodieSideChef');
    }
}
