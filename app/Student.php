<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'id');
    }

    function rating(){
        return $this->hasOne('App\Rating');
    }
}
