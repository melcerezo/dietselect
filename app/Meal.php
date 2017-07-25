<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{


//    public function ingredients(){
//        return $this->hasMany('App\Ingredient');
//    }

    public function ingredient_meal()
    {
        return $this->hasMany(IngredientMeal::class);
    }

    public function chefcustomize(){
        return $this->hasMany(ChefCustomizedMeal::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
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
