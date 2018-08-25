<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function person()
    {
        return $this->hasOne('App\Person', 'mail', 'email');
    }

    public function getIsMemberAttribute(){

      $paid_member = $this->person->membership_this_season->count() > 0;
      $life_member = $this->person->is_life_member == 1;
      $member = $paid_member || $life_member;
      return $member ;

    }

    public function canSeeAllPeople(){
      //member check only happens if person is set up in database, otherwise false
      if ($this->person['id']){
        return $this->person['can_see_all_people'];
      } else {
        return false;
      }
    }

    public function membershipid(){
      return $this->person->membershipid();
    }

    public function uniqid(){
      return $this->person->uniqid;
    }


}
