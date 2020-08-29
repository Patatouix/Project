<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
	protected $guarded = ['id'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function rdvs()
	{
		return $this->belongsToMany('App\Rdv')->withTimestamps();
	}

	public function foods()
	{
		return $this->belongsToMany('App\Food');
	}

	public function races()
	{
		return $this->belongsToMany('App\Race');
	}

	public function environments()
	{
		return $this->belongsToMany('App\Environment');
	}

	public function espece()
	{
		return $this->belongsTo('App\Espece');
	}

	public function sport()
	{
		return $this->belongsTo('App\Sport');
	}

	public function weight()
	{
		return $this->belongsTo('App\Weight');
	}

	public function age()
	{
		return $this->belongsTo('App\Age');
	}

	public function gender()
	{
		return $this->belongsTo('App\Gender');
	}

	public function sterilization()
	{
		return $this->belongsTo('App\Sterilization');
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
