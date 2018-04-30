<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crewtype extends Model
{
    protected $hidden = ['id', 'created_at', 'updated_at', 'function_id'];
}
