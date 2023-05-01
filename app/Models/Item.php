<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $attributes = ['discount' => 0];
    protected $fillable = ['description', 'price', 'qty', 'discount', 'vat_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function vat(){
        return $this->hasOne('App\Models\Vat', 'id', 'vat_id');
    }
}
