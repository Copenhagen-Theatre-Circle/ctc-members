<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends BaseModel
{
    public function audition_form_answers()
    {
        return $this->hasMany('App\AuditionFormAnswer');
    }
}
