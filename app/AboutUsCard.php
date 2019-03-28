<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUsCard extends Model
{
    public function about_us_category()
    {
        return $this->belongsTo('App\AboutUsCategory');
    }
}
