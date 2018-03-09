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
        'studentName', 'vatsim_id', 'email', 'rating', 'mentor',
    ];

    function user(){
        return $this->belongsTo('App\User', 'id');
    }

    function rating(){
        return $this->hasOne('App\Rating');
    }
}
