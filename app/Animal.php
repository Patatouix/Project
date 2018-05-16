<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['name', 'weight', 'age', 'sterilization', 'gender', 'user_id', 'species_id', 'environment_id', 'sport_id', 'food_id', 'race_id', 'image'];

    public function species()
	{
		return $this->belongsTo('App\Species');
	}

	public function race()
	{
		return $this->belongsTo('App\Race');
	} 

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function food()
	{
		return $this->belongsTo('App\Food');
	}

	public function sport()
	{
		return $this->belongsTo('App\Sport');
	} 

	public function environment()
	{
		return $this->belongsTo('App\Environment');
	}

	public function rdvs()
	{
		return $this->hasMany('App\Rdv');
	}
}
