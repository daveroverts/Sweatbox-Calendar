<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
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
