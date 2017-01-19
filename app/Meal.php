<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{


    public function ingredients(){
        return $this->hasMany('App\Ingredient');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }
}
