<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

	protected $fillable = ['name', 'description', 'short_description', 'price', 'image', 'tag_id'];

	public function commands()
	{
		return $this->hasMany('App\Command');
	} 

	public function tags()
	{
		return $this->belongsTo('App\Tag');
	}
}
