<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorSession extends Model
{
    protected $table = 'mentor_sessions';

    public function mentor(){
        return $this->belongsTo(Mentor::class);
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function type(){
        return $this->belongsTo('App\SessionType', 'typeSession_id');
    }
}
