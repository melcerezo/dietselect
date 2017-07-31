<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleCustomDetail extends Model
{
    public function simple_custom_plan()
    {
        return $this->belongsTo(SimpleCustomPlan::class);
    }


}
