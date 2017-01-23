<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{

    protected $table='meal_plans';

    public function meal(){
        return $this->hasMany('App\Meal');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }
}
