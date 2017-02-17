<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    protected $table='ingredient_meal';

//    public function meal(){
//        return $this->belongsTo('App\Meal');
//    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }

    protected $fillable=[
        'meal_id',
        'ingredient_id',
        'grams'
    ];
}
