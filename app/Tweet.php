<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = ['user_id','name','message'];
    protected $appends = ['createdDate'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

}
