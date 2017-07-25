<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChefCustomizedMeal extends Model
{
    public function customized_ingredient_meal()
    {
        return $this->hasMany(ChefCustomizedIngredientMeal::class, 'meal_id');
    }

    public function meal(){
        return $this->belongsTo(Meal::class);
    }

    public function mealplans(){
        return $this->belongsTo(MealPlan::class,'mealplan_id');
    }
    public function customized_meal(){
        return $this->hasMany(CustomizedMeal::class, 'meal_id');
    }
}
