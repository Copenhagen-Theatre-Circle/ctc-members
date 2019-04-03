<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{

  // protected $hidden = ['id', 'created_at', 'updated_at', 'character_id', 'person_id','projects_play_id','project_id','sort_value'];

  public function character()
  {
      return $this->belongsTo('App\Character')->select('id','name');
  }

  public function person()
  {
      return $this->belongsTo('App\Person')->select('id','first_name','last_name');
  }

  public function projects_play()
  {
      return $this->belongsTo('App\ProjectsPlay');
  }

}
