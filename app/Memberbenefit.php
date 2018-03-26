<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memberbenefit extends Model
{
    public function memberbenefitgroup(){
      return $this->belongsTo('App\Memberbenefitgroup');
    }
}
