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
  public function getCreatedDateAttribute() {
      return $this->created_at->diffForHumans();
  }
}
