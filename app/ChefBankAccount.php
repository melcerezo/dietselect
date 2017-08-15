<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChefBankAccount extends Model
{
    public function chef(){
        return $this->belongsTo(Chef::class);
    }
}
