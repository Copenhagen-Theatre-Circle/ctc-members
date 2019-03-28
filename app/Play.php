<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'author_id'];

    public function author_play()
    {
        return $this->hasMany('App\AuthorPlay');
    }
}
