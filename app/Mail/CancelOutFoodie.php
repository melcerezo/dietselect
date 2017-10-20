<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelOutFoodie extends Mailable
{
    use Queueable, SerializesModels;

    public $time;

    public $timeCancel;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($time,$timeCancel)
    {
        $this->time = $time;
        $this->timeCancel = $timeCancel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.cancelOutFoodie');
    }
}
