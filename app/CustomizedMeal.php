<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizedMeal extends Model
{
    public function customized_ingredient_meal()
    {
        return $this->hasMany(CustomizedIngredientMeal::class);
    }




    protected $fillable=[
        'id',
        'foodie_id',
        'description',
        'main_ingredient',
        'calories',
        'carbohydrates',
        'protein',
        'fat',

    ];
}
