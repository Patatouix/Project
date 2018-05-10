<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag','tag_url'];

	public function posts()
	{
		return $this->hasMany('App\Article');
	} 
}
