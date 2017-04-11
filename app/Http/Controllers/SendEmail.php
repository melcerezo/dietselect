<?php

namespace App\Http\Controllers;

use App\Notifications\VerifyEmail;
use Illuminate\Http\Request;

class SendEmail extends Controller
{
    public function createsEmailNotification($email)
    {

    }

    public function sendsOrderEmail()
    {
        $this->user()->notify(new VerifyEmail());
    }
}
