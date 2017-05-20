<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=[
        'chat_id',
        'sender_id',
        'receiver_id',
        'receiver_type',
        'subject',
        'message',
        'is_read',
    ];

    public function foodie(){
        return $this->belongsTo(Foodie::class);
    }
    public function message(){
        return $this->belongsTo(Chat::class);
    }

    public function chef(){
        return $this->belongsTo(Chef::class);
    }

    public function deposit()
    {
        return $this->hasOne(Deposit::class);
    }

}
