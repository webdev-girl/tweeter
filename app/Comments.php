<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = ['name','message'];

    public function tweets(){
        return $this->belongsTo('App\Tweets');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
