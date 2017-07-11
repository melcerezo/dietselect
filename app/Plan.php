<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{


    public function mealplans(){
        return $this->hasMany('App\MealPlan');
    }

    protected $fillable=[
        'calories',
        'carbohydrates',
        'protein',
        'fat',
        'price'
    ];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function chef(){
        return $this->belongsTo(Chef::class);
    }
    public function customizedMeals(){
        return $this->hasMany(CustomizedMeal::class, 'id');
    }

    public function custom_plan()
    {
        return $this->hasMany(CustomPlan::class);
    }


    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
