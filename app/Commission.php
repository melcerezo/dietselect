<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    public function chefs()
    {
        return $this->belongsTo(Chef::class);
    }
}
