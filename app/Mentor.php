<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sessions(){
        return $this->hasMany(MentorSession::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function action(){
        return $this->hasOne(Action::class,'id','action_id');
    }
}
