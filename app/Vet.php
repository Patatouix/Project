<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    protected $guarded = ['id'];

	public function rdvs()
	{
		return $this->hasMany('App\Rdv');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

	public function getImgPathAttribute()
    {
        if(!empty($this->image))
        {
            return asset('images/' . $this->image->name);
        }
        else
        {
            return null;
        }
    }
}
