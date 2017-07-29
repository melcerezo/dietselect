<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomPlan extends Model
{
    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }

    public function customized_meal(){
        return $this->hasMany(CustomizedMeal::class);
    }
}
