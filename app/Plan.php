<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'calories',
        'carbohydrates',
        'protein',
        'fat',
        'price'
    ];

    public function mealplans()
    {
        return $this->hasMany(MealPlan::class);
    }

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function chef()
    {
        return $this->belongsTo(Chef::class);
    }

    public function customizedMeals()
    {
        return $this->hasMany(CustomizedMeal::class, 'id');
    }
}
