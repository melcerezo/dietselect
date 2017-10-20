<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelFoodieSideFoodie extends Mailable
{
    use Queueable, SerializesModels;

    public $mailHTML;

    public $mailMess;

    public $time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailHTML,$mailMess,$time)
    {
        $this->mailHTML = $mailHTML;
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
            ->view('email.CancelFoodieSideFoodie');
    }
}
