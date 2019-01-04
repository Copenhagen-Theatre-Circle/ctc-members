<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essaytopic extends Model
{
    public function essaytopicanswers()
    {
        return $this->hasMany('App\Essaytopicanswer');
    }
}
