<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'vat',
        'name',
        'email',
        'phone',
        'password',
        'city_id',
        'prefix',
        'first_id'
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
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }

//    public function Invoice(){
//        return $this->hasMany('App\Models\Invoice','id', 'invoice_id');
//    }
    public function Invoices(){
        return $this->hasMany('App\Models\Invoice');
    }
    public function Clients(){
        return $this->belongsToMany('App\Models\Client', 'user_client');
    }
}
