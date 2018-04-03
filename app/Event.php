<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  public function event()
  {
      return $this->belongsTo('App\Project');
  }
}
