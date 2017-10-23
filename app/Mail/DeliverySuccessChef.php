<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeliverySuccessChef extends Mailable
{
    use Queueable, SerializesModels;

    public $foodieName;

    public $planName;

    public $time;

    public $startTime;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($foodieName,$planName,$time,$startTime)
    {
        $this->foodieName = $foodieName;
        $this->planName = $planName;
        $this->time = $time;
        $this->startTime = $startTime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('diet@dietselect.com')
            ->view('email.deliverChef');
    }
}
