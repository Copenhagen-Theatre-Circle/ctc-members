<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireAnswer extends Model
{

  // protected $visible = ['functiongroups','functions'];


  public function functiongroup()
    {
        return $this->hasOne('App\Functiongroup', 'id', 'functiongroup_id');
    }

  public function crewfunction()
    {
        return $this->hasOne('App\Crewfunction', 'id', 'function_id');
    }

  // public function getFunctiongroupAttribute()
  //     {
  //         return $this->functiongroups['questionnaire_name'];
  //     }
  //
  // public function getFunctionAttribute()
  //     {
  //         return $this->functions['questionnaire_name'];
  //     }    //


}
