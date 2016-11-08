<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    protected $fillable=[
        'foodie_id',
        'ingredient'
    ];




}
