<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends BaseModel
{
    protected $hidden = ['created_at', 'updated_at', 'season_id', 'venue_id', 'uuid', 'publish_online_flag', 'accounting_only'];

    public function audition_form_answers()
    {
        return $this->hasMany('App\AuditionFormAnswer');
    }

    public function hyperlinks()
    {
        return $this->hasMany('App\Hyperlink');
    }

    public function videos()
    {
        $video_array = Hyperlinktype::where('hyperlinkcategory_id',2)->get()->pluck('id');
        return $this->hasMany('App\Hyperlink')->whereIn('hyperlinktype_id',$video_array);
    }

    public function rights()
    {
        return $this->hasMany('App\Right');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function projects_plays()
    {
        return $this->hasMany('App\ProjectsPlay');
    }

    public function crewmembers()
    {
        return $this->hasMany('App\Crewmember');
    }

    public function projectmemories()
    {
        return $this->hasMany('App\Projectmemory');
    }

    public function audition_form_variables()
    {
        return $this->hasOne('App\AuditionFormVariable');
    }

    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function phototags()
    {
        return $this->hasMany('App\Phototag');
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }
}
