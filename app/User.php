<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'company',
        'street',
        'nr',
        'tva',
        'name',
        'email',
        'phone',
        'password',
        'city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function City(){
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function Invoice(){
        return $this->hasMany('App\Invoice','id', 'invoice_id');
    }
    public function Clients(){
        return $this->belongsToMany('App\Client', 'user_client');
    }
}
