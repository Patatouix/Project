<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conseiltag extends Model
{
    protected $guarded = ['id'];

    public function conseils()
    {
        return $this->belongsToMany('App\Conseil');
    }
}
