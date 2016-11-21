<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodiePreference extends Model
{

    //protected $table='foodie_preferences';

    protected $fillable = [
        'foodie_id',
        'ingredient'
    ];

}
