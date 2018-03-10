<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{

    protected $table = 'session_types';

    public function type(){
        return $this->belongsTo('App\Session', 'id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
