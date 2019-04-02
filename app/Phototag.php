<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phototag extends Model
{
    public function photograph()
    {
        return $this->belongsTo('App\Photograph');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
