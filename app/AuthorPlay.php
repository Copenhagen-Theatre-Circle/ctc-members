<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorPlay extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
