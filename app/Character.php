<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'play_id','age','description','sort_value'];
}
