<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'mentor_actions';

    public function mentor(){
        return $this->belongsToMany('App\Mentor', 'action_id');
    }
}
