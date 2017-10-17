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

    public function ismember(){
      return $this->person->ismember();
    }

    public function membershipid(){
      return $this->person->membershipid();
    }

    public function uniqid(){
      return $this->person->uniqid;
    }


}
