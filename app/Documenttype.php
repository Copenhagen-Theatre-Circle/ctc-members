<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documenttype extends Model
{
    public function getSlugAttribute()
    {
        return strtolower(str_replace(' ', '_', $this->name));
    }
}
