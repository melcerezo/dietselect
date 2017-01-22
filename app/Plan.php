<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    protected $table='plans';

    public function meals(){
        return $this->hasMany('App\Meal');
    }

    protected $fillable=[

    ];
}
