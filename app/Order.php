<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function foodie(){
        return $this->belongsTo(Foodie::class);
    }
    public function chef(){
            return $this->belongsTo(Chef::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function deposit()
    {
        return $this->hasOne(Deposit::class);
    }
    public function gcash()
    {
        return $this->hasOne(Gcash::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
