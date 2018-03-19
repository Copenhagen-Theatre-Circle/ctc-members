<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public function person()
  {
      return $this->belongsTo('App\Person');
  }

  protected $fillable = ['person_id','post_id','text'];

}
