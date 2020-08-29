<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	protected $guarded = ['id'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function produits()
	{
		return $this->belongsToMany('App\Produit');
	}
}
