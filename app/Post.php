<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['titre','contenu','user_id'];

	public function user() 
	{
		return $this->belongsTo('App\User');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Tag');
	} 

}