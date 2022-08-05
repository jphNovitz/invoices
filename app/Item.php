<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{

    protected $attributes = ['discount' => 0];
    protected $fillable = ['description', 'price', 'qty', 'discount', 'vat_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function vat(){
        return $this->hasOne('App\Vat', 'id', 'vat_id');
    }
}
