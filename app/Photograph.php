<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photograph extends Model
{
    public $fillable=['phototype_id','is_tagged','photographer_person_id'];

    public function phototags()
    {
           return $this->hasMany('App\Phototag');
    }

    public function phototype()
    {
            return $this->belongsTo('App\Phototype');
    }

    public function uploader()
    {
        return $this->belongsTo('App\Person','uploader_person_id')->select('id','first_name','last_name');
    }

    public function photographer()
    {
        return $this->belongsTo('App\Person','photographer_person_id')->select('id','first_name','last_name');
    }
}
