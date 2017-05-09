<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{

    protected $fillable = [
        'chef_id',
        'description',
        'main_ingredient',
        'calories',
        'carbohydrates',
        'protein',
        'fat',

    ];


//    public function ingredients(){
//        return $this->hasMany('App\Ingredient');
//    }

    public function mealplans()
    {
        return $this->hasMany(MealPlan::class);
    }

    public function ingredient_meal()
    {
        return $this->hasMany(IngredientMeal::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
