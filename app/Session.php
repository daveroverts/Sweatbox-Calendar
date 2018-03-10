<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function type(){
        return $this->belongsTo('App\SessionType', 'typeSession_id');
    }
}
