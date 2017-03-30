<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public function foodie()
    {
        return $this->belongsTo(Foodie::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
