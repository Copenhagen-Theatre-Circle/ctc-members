<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends BaseModel
{
    protected $hidden = ['created_at', 'updated_at', 'season_id', 'venue_id', 'uuid', 'publish_online_flag', 'accounting_only'];

    public function audition_form_answers()
    {
        return $this->hasMany('App\AuditionFormAnswer');
    }

    public function rights()
    {
        return $this->hasMany('App\Right');
    }

    public function projects_plays()
    {
        return $this->hasMany('App\ProjectsPlay');
    }

    public function projectmemories()
    {
        return $this->hasMany('App\Projectmemory');
    }

    public function audition_form_variables()
    {
        return $this->hasOne('App\AuditionFormVariable');
    }

}
