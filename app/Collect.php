<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    public function rents()
    {
        return $this->hasMany('App\Rent');
    }

    public function user()
	{
	    return $this->belongsTo('App\User');
	}
}
