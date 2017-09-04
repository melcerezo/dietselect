<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{

    public function foodie(){
        return $this->belongsTo(Foodie::class);
    }

    protected $fillable=[
        'foodie_id',
        'allergy'
    ];




}
