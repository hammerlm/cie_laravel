<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function creator() {
        return $this->belongsTo('App\User','creator_id');
    }

    public function modifier() {
        return $this->belongsTo('App\User','modifier_id');
    }
}
