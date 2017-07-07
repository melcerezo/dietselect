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
}
