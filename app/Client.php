<?php

namespace App;

use Illuminate\Auth\AuthManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
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
        $id = \Auth::user()->id;
        return $this->hasMany('App\Invoice')->where('user_id', $id);
//        return $this->hasMany('App\Invoice')->where('user_id','==', $id);
    }

    public function Users(){
        return $this->belongsToMany('App\User', 'user_client');
    }
}
