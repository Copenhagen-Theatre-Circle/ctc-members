<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireAnswer extends Model
{

  protected $appends = array('functiongroup','function');

  protected function functiongroups()
    {
        return $this->hasOne('App\Functiongroup', 'id', 'functiongroup_id');
    }

  protected function functions()
    {
        return $this->hasOne('App\Crewfunction', 'id', 'function_id');
    }

  public function getFunctiongroupAttribute()
      {
          return $this->functiongroups['questionnaire_name'];
      }

  public function getFunctionAttribute()
      {
          return $this->functions['questionnaire_name'];
      }    //


}
