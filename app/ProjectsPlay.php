<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsPlay extends BaseModel
{

  protected $hidden = ['id', 'created_at', 'updated_at', 'project_id', 'play_id'];

  public function play()
  {
      return $this->belongsTo('App\Play');
  }

  public function actors()
  {
      return $this->hasMany('App\Actor')->orderBy('sort_value');
  }

  public function crewmembers()
  {
      return $this->hasMany('App\Crewmember');
  }

  public function project()
  {
      return $this->belongsTo('App\Project');
  }

}
