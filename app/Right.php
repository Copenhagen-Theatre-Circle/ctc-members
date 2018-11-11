<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    public function person()
      {
          return $this->belongsTo('App\Person');
      }

   public function rightstype()
      {
          return $this->belongsTo('App\Rightstype');
      }
}
