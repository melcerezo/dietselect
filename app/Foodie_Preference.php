<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodie_Preference extends Model
{
    protected $fillable = [
        'foodie_id',
        'ingredient'
    ];

}
