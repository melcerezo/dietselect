<?php

namespace App;

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


}
