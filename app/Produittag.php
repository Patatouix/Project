<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produittag extends Model
{
	protected $guarded = ['id'];

	public function produits()
	{
		return $this->belongsToMany('App\Produit');
	}
}
