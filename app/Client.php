<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'company',
        'vat',
        'street',
        'nr',
        'city_id',
        'name',
        'email',
        'phone',
        'password',
    ];


    public function City(){
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function Invoices(){
        return $this->hasMany('App\Invoice');
    }

    public function Users(){
        return $this->belongsToMany('App\User', 'user_client');
    }
}
