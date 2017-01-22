<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    protected $table='meal_ingredients';

    public function meal(){
        return $this->belongsTo('App\Meal');
    }

    protected $fillable=[
        'grams'
    ];
}
