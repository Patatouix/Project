<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

	protected $fillable = ['name', 'description', 'short_description', 'price', 'image', 'id_tag'];

	public function commands()
	{
		return $this->hasMany('App\Command', 'id_article');
	} 

	public function tags()
	{
		return $this->belongsTo('App\Tag');
	}
}
