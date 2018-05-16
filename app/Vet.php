<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    protected $fillable = ['name'];

	public function rdvs()
	{
		return $this->hasMany('App\Rdv');
	}

}
