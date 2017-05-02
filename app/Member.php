<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function rents()
    {
        return $this->hasMany('App\Rent');
    }
}
