<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizedMeal extends Model
{
    public function customized_ingredient_meal()
    {
        return $this->hasMany(CustomizedIngredientMeal::class, 'meal_id');
    }

    public function chefcustomize(){
        return $this->belongsTo(ChefCustomizedMeal::class,'meal_id');
    }

    public function custom_plan(){
        return $this->belongsTo(CustomPlan::class);
    }


    protected $fillable=[
        'id',
        'foodie_id',
        'description',
        'custom_type',
        'custom_plan_id',
        'main_ingredient',
        'calories',
        'carbohydrates',
        'protein',
        'fat',

    ];
}
