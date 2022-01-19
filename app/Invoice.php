<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $table = 'invoice';

    protected $fillable = ['reference', 'client_id', 'user_id'];

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item');
    }


}
