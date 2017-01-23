<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{

    protected $table='meals';

    public function ingredients(){
        return $this->hasMany('App\Ingredient');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
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
