<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    function user(){
        return $this->belongsToMany('App\User', 'users', 'rating_id');
    }

    function student(){
        return $this->belongsToMany('App\Student', 'students', 'rating_id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
