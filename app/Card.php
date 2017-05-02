<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function rents()
    {
        return $this->hasMany('App\Rent');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
