<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
     protected $casts = [
    'options' => 'array',
    ];
    protected $appends = ['profileLink'];

    public function posts(){
      return $this->hasMany(Post::class);
  }

    public function getRouteKeyName(){
      return 'name';
  }

   public function getProfileLinkAttribute(){
      return route('user.show', $this);
  }
  //
  // public function following()
  // {
  //     return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
  // }

  public function isNot($user)
  {
      return $this->id !== $user->id;
  }

  // public function isFollowing($user)
  // {
  //     return (bool) $this->following->where('id', $user->id)->count();
  // }

  public function canFollow($user){
      if(!$this->isNot($user)) {
          return false;
      }
      return !$this->isFollowing($user);
  }

    public function canUnFollow($user){
        return $this->isFollowing($user);
    }
    //
    // public function followers()
    // {
    //     return $this->morphMany(Follower::class, 'following');
    // }
    // public function followers()
    // {
    //     return $this->morphMany('App\Following', 'follow');
    // }
    public function tweets(){
         return $this->hasMany('App\Tweet');
     }
     public function comments(){
         return $this->hasMany('App\Comment');
     }

     public function tweetlikes(){
        return $this>hasMany('App\Tweetlike');
    }

    public function user(){
        return $this->belongsToMany('App\User','followers','follows_id','user_id');
    }
    public function getFollowedByUserAttribute(){
        return $this->followers()->where('follows_id', Auth::id());
    }

//     public function followers(){
//         return $this->belongsToMany('App\User','followers', 'follows_id', 'user_id')->withTimestamps();
// }

// Get all users we are following
//     public function following(){
//         return $this->belongsToMany('App\User', 'followers', 'user_id', 'follows_id')->withTimestamps();
// }
// public function followers()
// {
//    return $this->belongsToMany(User::class, following, user_id, follows_id);
// }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
                    ->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
                    ->withTimestamps();
    }

    public function follow($userId)
    {
        $this->follows()->attach($userId);
        return $this;
    }

    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        return $this;
    }

    public function isFollowing($userId){
        return (boolean) $this->follows()->where('follows_id', $userId)->first(['id']);
    }
}
