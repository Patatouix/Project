<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
	protected $guarded = ['id'];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function animals()
	{
		return $this->belongsToMany('App\Animal')->withTimestamps();
	}

	public function vet()
	{
		return $this->belongsTo('App\Vet');
	}
}
