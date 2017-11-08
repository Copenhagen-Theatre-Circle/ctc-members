<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crewfunction extends Model
{
    protected $table = 'functions';//

    protected $appends = array('functiongroup');

    protected function functiongroups()
      {
          return $this->hasOne('App\Functiongroup', 'id', 'functiongroup_id');
      }

    public function getFunctiongroupAttribute()
        {
            return $this->functiongroups['questionnaire_name'];
        }

    public function getFunctionGroupSortOrderAttribute()
        {
            return $this->functiongroups['sort_order'];
        }

}
