<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends BaseModel
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    protected $fillable = ['posttype_id','person_id','title','body','is_anonymous'];

}
