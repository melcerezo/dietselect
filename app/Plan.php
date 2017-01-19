<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{


    public function meals(){
        return $this->hasMany('App\Meal');
    }
}
