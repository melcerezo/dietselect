<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

//    protected $table='meal_ingredients';

//    public function meal(){
//        return $this->belongsTo('App\Meal');
//    }

    public function ingredient_meal()
    {
        return $this->hasMany(IngredientMeal::class);
    }

//    protected $fillable=[
//        'meal_id',
//        'ingredient_id',
//        'grams'
//    ];
}
