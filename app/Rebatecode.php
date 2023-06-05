<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rebatecode extends Model
{
    //
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function getProjectNameAttribute()
    {
        return $this->project->name;
    }

    public function getPersonNameAttribute()
    {
        return $this->person->name;
    }


}