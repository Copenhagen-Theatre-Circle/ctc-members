<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essaytopic extends Model
{
    public function essaytopicanswers()
    {
        return $this->hasMany('App\Essaytopicanswer');
    }

    public function phototags()
    {
        return $this->hasMany('App\Phototag');
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }
}
