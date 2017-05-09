<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{

    protected $table='meal_plans';

    protected $fillable=[
        'plan_id',
        'meal_id',
        'customized_meals',
        'day',
        'meal_type',
    ];

    public function meal(){
        return $this->belongsTo(Meal::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function customize()
    {
        return $this->belongsTo('App\CustomizedMeal', 'customized_meals');
    }
}
