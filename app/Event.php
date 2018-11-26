<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $casts = [
            'date' => 'date'
        ];

  public function event()
  {
      return $this->belongsTo('App\Project');
  }
}
