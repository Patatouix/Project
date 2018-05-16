<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin'
    ];

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

    public function commands() 
    {
    return $this->hasMany('App\Command');
    }

    public function rdvs() 
    {
    return $this->hasMany('App\Rdv');
    }

    public function animals() 
    {
    return $this->hasMany('App\Animal');
    }
}
