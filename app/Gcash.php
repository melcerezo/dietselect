<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gcash extends Model
{
    protected $table='gcash';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
