<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    protected $fillable = ['request', 'response', 'status', 'user_id', 'animal_id', 'vet_id'];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function animal()
	{
		return $this->belongsTo('App\Animal');
	} 

	public function vet()
	{
		return $this->belongsTo('App\Vet');
	}

}
