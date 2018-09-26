<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photograph extends Model
{
    public function phototags()
       {
           return $this->hasMany('App\Phototag');
       }
}
