<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'vatsim_id', 'email', 'rating', 'mentor',
    ];

    public function currentMentor(){
        return $this->hasOne('App\User', 'id','mentor');
    }

    function currentRating(){
        return $this->hasOne('App\Rating', 'id');
    }
}
