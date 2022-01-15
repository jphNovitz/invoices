<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $table = 'invoice';

    protected $fillable = ['reference', 'client_id', 'user_id'];

    public function Client(){
        return $this->belongsTo('App\Client');
    }

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item');
    }


}
