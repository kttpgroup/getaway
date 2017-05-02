<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'checkIn',
        'checkOut',
    ];

    public function member()
	{
	    return $this->belongsTo('App\Member');
	}

	public function card()
	{
	    return $this->belongsTo('App\Card');
	}

	public function collect()
	{
	    return $this->belongsTo('App\Collect');
	}
}
