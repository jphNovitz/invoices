<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    public function Client(){
        return $this->belongsTo('App\Client');
    }

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

}
