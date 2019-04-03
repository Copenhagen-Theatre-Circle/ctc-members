<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsPlay extends BaseModel
{

  protected $hidden = ['id', 'created_at', 'updated_at', 'project_id', 'play_id'];

  public function play()
  {
      return $this->belongsTo('App\Play')->select('id','title');
  }

  public function characters()
  {
    return $this->hasMany('App\Character','play_id','play_id');
  }

  public function actors()
  {
      return $this->hasMany('App\Actor')->orderBy('sort_value')->select('id','character_id', 'projects_play_id', 'person_id');
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
