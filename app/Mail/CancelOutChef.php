<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelOutChef extends Mailable
{
    use Queueable, SerializesModels;

    public $planName;

    public $foodieName;

    public $timeCancel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($planName,$foodieName,$timeCancel)
    {
        $this->planName = $planName;
        $this->foodieName = $foodieName;
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
