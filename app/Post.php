<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends BaseModel
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function posttype()
    {
        return $this->belongsTo('App\Posttype');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    protected $fillable = ['posttype_id','person_id','title', 'lead', 'body','is_anonymous'];

}
