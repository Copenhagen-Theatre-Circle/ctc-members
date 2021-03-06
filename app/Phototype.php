<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phototype extends Model
{
    // protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return strtolower(str_replace(' ', '_', $this->name));
    }
}
