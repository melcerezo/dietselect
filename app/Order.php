<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function foodie(){
        return $this->belongsTo(Foodie::class);
    }
    public function deposit()
    {
        return $this->hasOne(Deposit::class);
    }
    public function gcash()
    {
        return $this->hasOne(Gcash::class);
    }
    public function paypal(){
        return $this->hasOne(PayPal::class);
    }

    public function order_item(){
        return $this->hasMany(OrderItem::class);
    }
}
