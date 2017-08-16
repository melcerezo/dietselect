<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPal extends Model
{
     protected $table='paypal';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
