<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{

    protected $table='meal_plans';

    public function meal(){
        return $this->belongsTo('App\Meal','meal_id');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    public function customized_meal(){
        return $this->belongsTo('App\CustomizedMeal','customized_meal_id');
    }


    protected $fillable=[
        'plan_id',
        'meal_id',
        'customized_meal_id',
        'day',
        'meal_type',
    ];

}
