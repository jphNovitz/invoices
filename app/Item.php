<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    public function rate()
    {
        return $this->hasOne('App\Phone');
    }
}
