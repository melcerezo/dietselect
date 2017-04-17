<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizedMeal extends Model
{
    public function customized_ingredient_meal()
    {
        return $this->hasMany(CustomizedIngredientMeal::class, 'meal_id');
    }

    public function mealplan(){
        return $this->hasMany(MealPlan::class);
    }


    protected $fillable=[
        'id',
        'foodie_id',
        'description',
        'custom_type',
        'order_id',
        'main_ingredient',
        'calories',
        'carbohydrates',
        'protein',
        'fat',

    ];
}
