<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function foodie(){
        return $this->belongsTo(Foodie::class);
    }

    public function chef(){
        return $this->belongsTo(Chef::class);
    }


    protected $fillable=[
        'sender_id',
        'receiver_id',
        'receiver_type',
        'message',
        'is_read',
    ];
}
