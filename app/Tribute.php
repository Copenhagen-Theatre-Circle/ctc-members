<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tribute extends Model
{
    public function deceased()
    {
        return $this->belongsTo('App\Person','person_id__deceased');
    }

    public function tribute_from()
    {
        return $this->belongsTo('App\Person','person_id');
    }
}
