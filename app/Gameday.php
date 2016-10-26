<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gameday extends Model
{
    public function location() {
        return $this->belongsTo('App\Location');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }
}
