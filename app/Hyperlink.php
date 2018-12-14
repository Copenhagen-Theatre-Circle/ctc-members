<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hyperlink extends Model
{
    public function hyperlinktype()
    {
        return $this->belongsTo('App\Hyperlinktype');
    }
}
