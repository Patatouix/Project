<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
	protected $guarded = ['id'];

	public function reservations()
	{
		return $this->belongsToMany('App\Reservation');
	}

	public function produittags()
	{
		return $this->belongsToMany('App\Produittag');
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
