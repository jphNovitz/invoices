<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function __toString()
    {
        return $this->code.' - '.$this->city;
    }
}
