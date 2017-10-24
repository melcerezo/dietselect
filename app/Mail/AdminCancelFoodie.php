<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminCancelFoodie extends Mailable
{
    use Queueable, SerializesModels;

    public $foodieName;

    public $time;

    public $mailMess;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($foodieName,$time,$mailMess)
    {
        $this->foodieName = $foodieName;
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
            ->view('email.adminCancelFoodie');
    }
}
