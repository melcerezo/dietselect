<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable=[
        'foodie_id',
        'chef_id'
    ];

    public function message(){
        return $this->hasMany(Message::class);
    }

    public function foodie(){
        return $this->belongsTo(Foodie::class);
    }

    public function chef(){
        return $this->belongsTo(Chef::class);
    }

    public function notRead()
    {
        return $this->message()->where('is_read', 0)->count();
    }
}
