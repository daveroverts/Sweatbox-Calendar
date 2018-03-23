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
        'name', 'vatsim_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sessions(){
        return $this->hasMany(Session::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    function rating(){
        return $this->hasOne('App\Rating', 'id', 'rating_id');
    }

    public function isAdmin(){
        if ($this->isAdmin == 1){
            return true;
        }
        else return false;
    }
}
