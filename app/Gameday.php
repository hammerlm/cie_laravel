<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gameday extends Model
{
    public function location() {
        return $this->belongsTo('App\Location');
    }

    public function users() {
        return $this->belongsToMany('App\User')->withPivot('is_goalie', 'is_coach', 'is_ref');
    }
}
