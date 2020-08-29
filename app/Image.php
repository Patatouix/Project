<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id'];

	public function animal()
	{
		return $this->hasOne('App\Animal');
	}

    public function produit()
	{
		return $this->hasOne('App\Produit');
	}

	public function vet()
	{
		return $this->hasOne('App\Vet');
    }

    public function user()
	{
		return $this->hasOne('App\User');
	}
}
