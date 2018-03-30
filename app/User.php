<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    function rating(){
        return $this->hasOne('App\Rating', 'id', 'rating_id');
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function mentor(){
        return $this->belongsTo(Mentor::class);
    }

    public function isAdmin(){
        if ($this->isAdmin == 1){
            return true;
        }
        else return false;
    }
}
