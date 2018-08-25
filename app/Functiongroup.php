<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functiongroup extends Model
{
  public function crewfunctions()
    {
        return $this->hasMany('App\Crewfunction');
    }
}
