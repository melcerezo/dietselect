<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    public function chef()
    {
        return $this->belongsTo(Chef::class,'chef_id');
    }
}
