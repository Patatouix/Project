<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = ['name', 'advice'];

    public function species()
	{
		return $this->belongsTo('App\Species');
	}

	public function animals()
	{
		return $this->hasMany('App\Animal');
	} 
}
