<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user () {
        return $this->belongsTo('App\User');
    }

    public function commands () {
        return $this->hasMany('App\Command');
    }

    public function incrementCommand() {

    }
}
