<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    public function vat(){
        return $this->hasOne('App\Vat', 'id', 'vat_id');
    }
}
