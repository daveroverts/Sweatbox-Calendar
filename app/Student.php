<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'vatsim_id', 'email', 'rating_id', 'mentor_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function currentMentor(){
        return $this->hasOne('App\User', 'id','mentor_id');
    }

    public function currentMentor(){
        return $this->hasOne('App\Mentor', 'id','mentor_id');
    }
}
