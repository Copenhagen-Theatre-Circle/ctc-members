<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends BaseModel
{

    public function myMethod()
    {

    }

    protected $visible = ['first_name','last_name','portraits','roles','crewjobs','questionnaire_answers','member_bio'];

    // model relationships

    public function memberships()
    {
        return $this->hasMany('App\Membership');
    }

    public function membership_this_season()
    {
        return $this->hasMany('App\Membership')->where('season_id', '50');
    }

    public function portraits()
    {
        return $this->hasMany('App\Photograph')->orderBy('created_at', 'desc');
    }

    public function mainportrait ()
      {
          return $this->hasMany('App\Photograph')->orderBy('created_at', 'desc')->pluck('file_name')->first();
      }

    public function rights()
    {
        return $this->hasMany('App\Right');
    }

    public function questionnaire_answers()
    {
        return $this->hasMany('App\QuestionnaireAnswer');
    }

    public function roles()
    {
        return $this->hasMany('App\Actor');
    }

    public function crewjobs()
    {
        return $this->hasMany('App\Crewmember');
    }

    //custom methods

    public function ismember()
    {
        $paid_member = $this->membership_this_season()->exists();
        $life_member = $this['is_life_member'] == 1;
        $member = $paid_member || $life_member;
        return $member ;
    }

    // protected $appends = array('is_current_member');

    //scopes

    public function scopeIsMember($query)
    {
        return $query->whereHas('membership_this_season');
    }

    public function scopeAnsweredQuestionnaire($query)
    {
        return $query->whereHas('questionnaire_answers');
    }

    public function scopeAnsweredQuestionnaireOrIsMember($query)
    {
        return $query->whereHas('membership_this_season')
      ->orWhereHas('questionnaire_answers');
    }




    // public function answeredQuestionnaire()
    //   {
    //       $answered = $this->questionnaire_answers()->where('id', '>', '0')->first() ? true : false;
    //       return $answered ;
    //   }

    // public function isPaidUpMember()
    //   {
    //       $paid_member = $this->memberships()->where('season_id', '>', '49')->first() ? true : false;
    //       $life_member = $this['is_life_member'] == 1;
    //       $member = $paid_member || $life_member;
    //       return $member ;
    //   }

    public function getMainPortraitAttribute ()
      {
          $portrait = $this->portraits()->orderBy('created_at', 'desc')->first()['file_name'];
          return $portrait;
      }


    // protected $appends = array('main_portrait');

    // public function getPortraitAttribute()
    //
    //  {
    //    $portrait = $this->portraits()->orderBy('created_at', 'desc')->first()['file_name'];
    //    return $portrait;
    //  }

    public function getQuestionnaireAnsweredAttribute()
    {
        $created_at = $this->questionnaire_answers()->first()['created_at'];
        if ($created_at) {
            $created_date = date('d M Y', strtotime($created_at));
            return $created_date;
        } else {
            return false;
        }
    }

    // public function getMemberAttribute() {
  //   return $this->ismember();
  // }
}
