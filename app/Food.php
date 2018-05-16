<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = ['name', 'advice'];

	public function animals()
	{
		return $this->hasMany('App\Animal');
	} 
}
