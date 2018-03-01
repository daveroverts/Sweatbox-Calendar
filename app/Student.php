<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    function user(){
        $this->belongsTo(User::class);
    }
}
