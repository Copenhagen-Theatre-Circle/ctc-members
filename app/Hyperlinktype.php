<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hyperlinktype extends Model
{
    public function hyperlinkcategory()
    {
        return $this->belongsTo('App\Hyperlinkcategory');
    }
}
