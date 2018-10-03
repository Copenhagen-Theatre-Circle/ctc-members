<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JubileeBookAnswer extends Model
{
    protected $fillable = ['person_id','decades','shows','series','essays'];
}
