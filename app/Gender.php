<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $guarded = ['id'];

    public function conseils()
    {
        return $this->belongsToMany('App\Conseil');
    }

    public function animals()
    {
        return $this->hasMany('App\Animal');
    }
}
