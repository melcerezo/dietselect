<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=[
        'sender_id',
        'receiver_id',
        'receiver_type',
        'message',
        'is_read',
    ];

    public function foodie(){
        return $this->belongsTo(Foodie::class);
    }

    public function chef(){
        return $this->belongsTo(Chef::class);
    }

    public function deposit()
    {
        return $this->hasOne(Deposit::class);
    }

}
