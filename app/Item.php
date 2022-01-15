<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $fillable = ['description', 'price', 'qty', 'discount', 'vat_id'];

    public function vat(){
        return $this->hasOne('App\Vat', 'id', 'vat_id');
    }
}
