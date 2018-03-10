<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

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
