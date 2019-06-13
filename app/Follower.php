<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    public function follower(){
        return $this->belongsToMany('App/User');
}



}
