<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{

	protected $fillable = ['takeout', 'id_user', 'id_article', 'status'];

	public function user() 
	{
		return $this->belongsTo('App\User', 'id_user');
	}

	public function articles()
	{
		return $this->belongsTo('App\Article', 'id_article');
	} 
}
