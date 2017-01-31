<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{


    public function ingredients(){
        return $this->hasMany('App\Ingredient');
    }

    public function mealplan(){
        return $this->hasOne('App\MealPlan');
    }

    protected $fillable=[
        'description',
        'main_ingredient',
        'calories',
        'carbohydrates',
        'protein',
        'fat',

    ];


}
