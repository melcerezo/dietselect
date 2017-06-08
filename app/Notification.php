<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable=[
        'sender_id',
        'receiver_id',
        'receiver_type',
        'notification',
        'is_read',
    ];

    public function foodie(){
        return $this->belongsTo(Foodie::class);
    }

    public function chef(){
        return $this->belongsTo(Chef::class);
    }
}
