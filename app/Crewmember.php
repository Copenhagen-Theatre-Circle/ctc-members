<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crewmember extends Model
{
  protected $hidden = ['id', 'created_at', 'updated_at', 'crewfunction_id', 'play_id', 'crewtype_id','person_id','projects_play_id','project_id'];

  public function crewtype()
  {
      return $this->belongsTo('App\Crewtype');
  }

  public function person()
  {
      return $this->belongsTo('App\Person');
  }

  public function projects_play()
  {
      return $this->belongsTo('App\ProjectsPlay');
  }

  public function project()
  {
      return $this->belongsTo('App\Project');
  }
}
