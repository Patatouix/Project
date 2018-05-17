<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{

	protected $fillable = ['takeout', 'user_id', 'article_id', 'status'];

	public function user() 
	{
		return $this->belongsTo('App\User');
	}

	public function article()
	{
		return $this->belongsTo('App\Article');
	} 
}
