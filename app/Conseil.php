<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conseil extends Model
{
    protected $guarded = ['id'];

    public function conseiltags()
    {
        return $this->belongsToMany('App\Conseiltag');
    }

    public function sterilizations()
    {
        return $this->belongsToMany('App\Sterilization');
    }

    public function genders()
    {
        return $this->belongsToMany('App\Gender');
    }

    public function ages()
    {
        return $this->belongsToMany('App\Age');
    }

    public function weights()
    {
        return $this->belongsToMany('App\Weight');
    }

    public function environments()
    {
        return $this->belongsToMany('App\Environment');
    }

    public function especes()
    {
        return $this->belongsToMany('App\Espece');
    }

    public function races()
    {
        return $this->belongsToMany('App\Race');
    }

    public function foods()
    {
        return $this->belongsToMany('App\Food');
    }

    public function sports()
    {
        return $this->belongsToMany('App\Sport');
    }
}
