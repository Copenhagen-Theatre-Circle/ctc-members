<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditionFormAnswer extends BaseModel
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function getFirstNameAttribute()
    {
        return $this->person->first_name;
    }

    protected $appends = ['first_name'];
}
