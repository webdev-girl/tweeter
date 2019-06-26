<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $appends = ['createdDate'];
    protected $fillable = ['name','message'];

    public function tweets(){
        return $this->belongsTo('App\Tweet');
    }

    public function user(){
      return $this->belongsTo('App\User');
  }
  public function post(){
      return $this->belongsTo('App\Post');
  }

  public function getCreatedDateAttribute() {
      return $this->created_at->diffForHumans();
  }

public function tweetlikes()
{
    return $this->morphMany('App\Tweetlike', 'Likeable');
}
public function like()
{
    return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);
}
public function getIsLikedAttribute()
{
    $like = $this->likes()->whereUserId(Auth::id())->first();
    return (!is_null($like)) ? true : false;
}
}
