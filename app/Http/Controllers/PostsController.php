<?php

namespace App\Http\Controllers;

use Lecturize\Followers\Exceptions\AlreadyFollowingException;
use Lecturize\Followers\Exceptions\CannotBeFollowedException;
use Lecturize\Followers\Exceptions\FollowerNotFoundException;
use Lecturize\Followers\Models\Follower;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;
class PostsController extends Controller{

    public function index(){
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
}
    public function show($id){
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
}
    public function create(){
        return view('posts.create');
}
    public function store(Request $request){
        $this->validate($request, [
            'title'        => 'required|max:255',
            'description'  => 'required|max:255'
        ]);
        Post::create([
            'title'  => $request->input('title'),
            'description' => $request->input('description'),
            'user_id'  => Auth::user()->id,
        ]);
        return redirect('/posts')->with('status', 'post was created successfully');
}
    public function edit(Post $post){
        return view('posts.edit', compact('post'));
}
public function update(Request $request, Post $post)
{
    $this->validate($request, [
        'title'       => 'required|max:255',
        'description' => 'required|max:255',
    ]);
    $post->update($request->all());
    return back()->with('success', 'Post info updated successfully.');
}
    public function destroy(Post $post){
        $post->delete();
        return redirect('/posts')->with('success', 'Post was deleted');
}
    public function indexFollow(Request $request, Post $post){
        $posts = $post->whereIn('user_id', $request->user()->followers()
                        ->pluck('users.id')
                        ->push($request->user()->id))
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->take($request->get('limit', 10))
                        ->get();

        return response()->json($posts);
    }
    public function storeFollow(Request $request, Post $post)
    {
        $newPost = $request->user()->posts()->create([
            'body' => $request->get('body')
        ]);

        return response()->json($post->with('user')->find($newPost->id));
    }


/**
 * Class CanFollow
 * @package Lecturize\Followers\Traits
 */
/**
     * Get all followable items this model morphs to as a follower.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    // public function followables()
    // {
    //     return $this->morphMany(Follower::class, 'follower');
    // }
    /**
     * Follow a followable model.
     *
     * @param  mixed  $followable
     * @return mixed
     *
     * @throws AlreadyFollowingException
     * @throws CannotBeFollowedException
     */
    // public function follow($followable)
    // {
    //     if ($isFollower = $this->isFollowing($followable) !== false) {
    //         throw new AlreadyFollowingException( get_class($this) .'::'. $this->id .' is already following '. get_class($followable) .'::'. $followable->id );
    //     }
    //     if ($followable->follower()) {
    //         cache()->forget($this->getFollowingCacheKey());
    //         return Follower::create([
    //             'follows_id'     => $this->id,
    //             'follower_type'   => get_class($this),
    //             'followable_id'   => $followable->id,
    //             'followable_type' => get_class($followable),
    //         ]);
    //     }
    //     throw new CannotBeFollowedException(get_class($followable) .'::'. $followable->id .' cannot be followed.');
    // }
    /**
     * Unfollow a followable model.
     *
     * @param  mixed  $followable
     * @return mixed
     *
     * @throws FollowerNotFoundException
     */
    // public function unfollow($followable)
    // {
    //     if ($isFollower = $this->isFollowing($followable) === true) {
    //         cache()->forget($this->getFollowingCacheKey());
    //         return Follower::following($followable)
    //                        ->followedBy($this)
    //                        ->delete();
    //     }
    //     throw new FollowerNotFoundException(get_class($this) .'::'. $this->id .' is not following '. get_class($followable) .'::'. $followable->id);
    // }
    /**
     * Check whether this model is following a given followable model.
     *
     * @param  mixed  $followable
     * @return bool
     */
    // public function isFollowing($followable)
    // {
    //     $query = Follower::following($followable)
    //                      ->followedBy($this);
    //     return (bool) $query->count() > 0;
    // }
    /**
     * Get the following count.
     *
     * @return int
     */
    // public function getFollowingCount()
    // {
    //     $key = $this->getFollowingCacheKey();
    //     return cache()->remember($key, config('lecturize.followers.cache.expiry', 10), function() {
    //         $count = 0;
    //         Follower::where('follows_id',   $this->id)
    //                 ->where('follower_type', get_class($this))
    //                 ->chunk(1000, function ($models) use (&$count) {
    //                       $count = $count + count($models);
    //                   });
    //         return $count;
    //     });
    // }
    /**
     * @param  int     $limit
     * @param  string  $type
     * @return mixed
     */
    // public function getFollowing($limit = 0, $type = '')
    // {
    //     if ($type) {
    //         $followables = $this->followables()->where('followable_type', $type)->get();
    //     } else {
    //         $followables = $this->followables()->get();
    //     }
    //     $return = [];
    //     foreach ($followables as $followable)
    //         $return[] = $followable->followable()->first();
    //     $collection = collect($return)->shuffle();
    //     if ($limit == 0)
    //         return $collection;
    //     return $collection->take($limit);
    // }
    /**
     * Get the cache key.
     *
     * @return string
     */
    // private function getFollowingCacheKey()
    // {
    //     $model = get_class($this);
    //     $model = substr($model, strrpos($model, '\\') + 1);
    //     $model = strtolower($model);
    //     return 'followers.'. $model .'.'. $this->id .'.following.count';
    // }
    /**
     * Scope follows.
     *
     * @param  object  $query
     * @return mixed
     */
    // public function scopeFollows($query)
    // {
    //     return $query->whereHas('followables', function($q) {
    //         $q->where('follows_id',   $this->id);
    //         $q->where('follower_type', get_class($this));
    //     });
    // }

/**
 * Class CanBeFollowed
 * @package Lecturize\Followers\Traits
 */

    /**
     * Get all followable items this model morphs to as being followed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */

    /**
     * Add a follower.
     *
     * @param  mixed  $follower
     * @return mixed
     * @throws AlreadyFollowingException
     * @throws CannotBeFollowedException
     */
    // public function addFollower($follower)
    // {
    //     // check if $follower is already following this
    //     if ($hasFollower = $this->hasFollower($follower) !== false)
    //         throw new AlreadyFollowingException(get_class($follower) .'::'. $follower->id .' is already following '. get_class($this) .'::'. $this->id);
    //     // check if $follower can follow (has CanFollow)
    //     if (! $follower->followables())
    //         throw new CannotBeFollowedException(get_class($follower) .'::'. $follower->id .' cannot follow this.');
    //     cache()->forget($this->getFollowerCacheKey());
    //     return Follower::create([
    //         'follows_id'     => $follower->id,
    //         'follower_type'   => get_class($follower),
    //         'followable_id'   => $this->id,
    //         'followable_type' => get_class($this),
    //     ]);
    // }
    /**
     * Delete a follower.
     *
     * @param  mixed  $follower
     * @return mixed
     *
     * @throws FollowerNotFoundException
     */
    // public function deleteFollower($follower)
    // {
    //     if ($hasFollower = $this->hasFollower($follower) === true) {
    //         cache()->forget($this->getFollowerCacheKey());
    //         return Follower::followedBy($follower)
    //                        ->following($this)
    //                        ->delete();
    //     }
    //     throw new FollowerNotFoundException(get_class($follower) .'::'. $follower->id .' is not following '. get_class($this) .'::'. $this->id);
    // }
    /**
     * Check whether this model has a given follower.
     *
     * @param  mixed  $follower
     * @return bool
     */
    // public function hasFollower($follower)
    // {
    //     $query = Follower::followedBy($follower)
    //                      ->following($this);
    //     return (bool) $query->count() > 0;
    // }
    /**
     * Get the follower count.
     *
     * @return int
     */
    // public function getFollowerCount()
    // {
    //     $key = $this->getFollowerCacheKey();
    //     return cache()->remember($key, config('lecturize.followers.cache.expiry', 10), function() {
    //         $count = 0;
    //         Follower::where('followable_id',   $this->id)
    //                 ->where('followable_type', get_class($this))
    //                 ->chunk(1000, function ($models) use (&$count) {
    //                       $count = $count + count($models);
    //                 });
    //         return $count;
    //     });
    // }
    /**
     * @param  int     $limit
     * @param  string  $type
     * @return mixed
     */
    // public function getFollowers($limit = 0, $type = '')
    // {
    //     if ($type) {
    //         $followers = $this->follower()->where('follower_type', $type)->get();
    //     } else {
    //         $followers = $this->follower()->get();
    //     }
    //     $return = [];
    //     foreach ($followers as $follower)
    //         $return[] = $follower->follower()->first();
    //     $collection = collect($return)->shuffle();
    //     if ($limit === 0)
    //         return $collection;
    //     return $collection->take($limit);
    // }
    /**
     * Get the cache key.
     *
     * @return string
     */
    // private function getFollowerCacheKey()
    // {
    //     $model = get_class($this);
    //     $model = substr($model, strrpos($model, '\\') + 1);
    //     $model = strtolower($model);
    //     return 'followers.'. $model .'.'. $this->id .'.follower.count';
    // }
    // /**
    //  // * Scope followers.
    //  *
    // //  * @param  object  $query
    // //  * @return mixed
    // //  */
    // public function scopeFollowers($query)
    // {
    //     return $query->whereHas('follower', function($q) {
    //         $q->where('followable_id', $this->id);
    //         $q->where('followable_type', get_class($this));
    //     });
    // }
}
