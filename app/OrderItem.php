<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function refund()
    {
        return $this->hasOne(Refund::class);
    }

    public function commission()
    {
        return $this->hasOne(Commission::class);
    }
}
