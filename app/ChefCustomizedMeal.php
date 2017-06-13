<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChefCustomizedMeal extends Model
{
    public function customized_ingredient_meal()
    {
        return $this->hasMany(ChefCustomizedIngredientMeal::class, 'meal_id');
    }

    public function mealplan(){
        return $this->hasMany(MealPlan::class);
    }
}
