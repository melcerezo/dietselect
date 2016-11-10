<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodie_Preference extends Model
{

    protected $table='foodie_preferences';

    protected $fillable = [
        'foodie_id',
        'ingredient'
    ];

}
