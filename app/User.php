<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id', 'admin'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function rdvs()
    {
        return $this->hasMany('App\Rdv');
    }

    public function animals()
    {
        return $this->hasMany('App\Animal');
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

    public function canJoinRoom($id)
    {
        return $this->id == $id;
    }
}
