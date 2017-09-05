<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleCustomMeal extends Model
{
    public function simple_custom_plan()
    {
        return $this->belongsTo(SimpleCustomPlan::class);
    }

    public function chef_customized_meal()
    {
        return $this->belongsTo(ChefCustomizedMeal::class);
    }

    public function simple_custom_detail()
    {
        return $this->hasMany(SimpleCustomDetail::class);
    }
}
