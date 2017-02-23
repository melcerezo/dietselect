<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{


//    public function ingredients(){
//        return $this->hasMany('App\Ingredient');
//    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function mealplan(){
        return $this->hasMany(MealPlan::class);
    }

    protected $fillable=[
        'chef_id',
        'description',
        'main_ingredient',
        'calories',
        'carbohydrates',
        'protein',
        'fat',

    ];


}
