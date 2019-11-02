<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    public function __toString()
    {
        return $this->code.' - '.$this->city;
    }
}
