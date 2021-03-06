<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    public function foodie()
    {
        return $this->belongsTo(Foodie::class);
    }
    public function order_item()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
