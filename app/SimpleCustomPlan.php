<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleCustomPlan extends Model
{
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function simple_custom_detail()
    {
        return $this->hasMany(SimpleCustomDetail::class);
    }


}
