<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{

    public function user(){
      return $this->belongsTo(User::class);
  }

    public function followers(){
        return $this->hasMany('App\Followers');
 }
}
