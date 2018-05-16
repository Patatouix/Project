<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = ['name', 'advice'];

    public function animals()
	{
		return $this->hasMany('App\Animal');
	}

	public function races()
	{
		return $this->hasMany('App\Race');
	}  
}
