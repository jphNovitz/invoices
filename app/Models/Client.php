<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }

    public function Invoices(){
        $id = \Auth::user()->id;
        return $this->hasMany('App\Models\Invoice')->where('user_id', $id);
    }

    public function Users(){
        return $this->belongsToMany('App\Models\User', 'user_client');
    }
}
