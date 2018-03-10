<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function currentStudent(){
        return $this->belongsTo('App\Student', 'id');
    }

    public function type(){
        return $this->belongsTo('App\SessionType', 'id');
    }
}
