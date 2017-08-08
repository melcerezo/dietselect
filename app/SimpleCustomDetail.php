<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleCustomDetail extends Model
{
//    protected $table='simple_custom_details';


    public function simple_custom_plan()
    {
        return $this->belongsTo(SimpleCustomPlan::class);
    }


}
