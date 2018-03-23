<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    public function people()
      {
          return $this->belongsTo('App\Person');
      }
}
