<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $guarded = ['id'];

	public function conseils()
    {
        return $this->belongsToMany('App\Conseil');
    }

    public function animals()
    {
        return $this->belongsToMany('App\Animal');
	}

	public function espece()
	{
		return $this->belongsTo('App\Espece');
	}
}
