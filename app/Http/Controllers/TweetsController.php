<?php

namespace App\Http\Controllers;
use DB;
use App\Tweet;
use App\Tweetlike;
use App\Follower;
use App\Following;
use App\Comment;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Tweet as TweetResource;
use App\Http\Resources\TweetLike as TweetlikeResource;
use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\Follower as FollowerResource;

class TweetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    // public function index(){
        public function index(Request $request, Tweet $tweet){
        $tweets = $tweet->whereIn('user_id', $request->user()->following()
                          ->pluck('users.id')
                          ->push($request->user()->id))
                          ->with('user')
                          ->orderBy('created_at', 'desc')
                          ->take($request->get('limit', 10))
                          ->get();

        $user_id = Auth::user()->id;
        $user = new User;
        $users = $user;
        $editTweet = new Tweet;
        $tweetLike = new TweetLike;
        $followers = new Follower;
        $potentialFollowers = $users = $user->get();
        // $follower = $follower->where("user_id",$user->id)->where("following", 1)->get(array('id'))->toArray();

        // $count = count($tweets);
        // $count = $tweets;
        $name = new User;
        $currentUserId = $user->id;
        $names = $name->where('id', '!=', $currentUserId)->get();
        $users = new User;
        $follower = $users = $users->get();
        $user = Auth::user();
        $tweet = new Tweet;
        $tweets = $tweet->get();
        $comment = new Comment;
        $comments = $comment->get();
        $tweets = $tweet->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $tweet = Tweet::orderBy('created_at','desc')->get();
        $tweetCollection = array();
        foreach ($tweets as $tweet) {

        $newTweet = $tweet;
        $newTweet['comments'] = $comments;
        $comment= Tweet::find($tweet->id)->comment;
        $newTweet['liked'] = false;
        $tweetLike = \DB::table('tweetlikes')->where('user_id',$user->id)->where('tweet_id',$tweet->id)->orderBy('created_at','DESC')->first();
        if(isset($tweetLike->like) && ($tweetLike->like == "1")){
            $newTweet['liked'] = true;
        }
        $newTweet['user'] = Tweet::find($tweet->id)->user;
        if($user->id == $tweet->user_id){
            $newTweet['has_permissions'] = 1;
        }
            if($user->id == $tweet->user_id){
                $newTweet['can_delete'] = 1;
                }
        $tweetCollection[] = $newTweet;
    }
    $tweets = $tweetCollection;

    return view('home',compact('tweets','user'));
}
public function saveTweet(Request $request){
    $this->middleware('auth');
    $user = Auth::user();
    $tweet = new Tweet;
    $tweet ->user_id = $user->id;
    $tweet ->tweet = $request->tweet;
    $tweet -> save();
    return redirect('home');
}
public function saveComment(Request $request){
    $this->middleware('auth');
    $user = Auth::user();
    $comment = new Comment;
    $comment ->user_id = $user->id;
    $comment ->tweet_id = $request->tweet_id;
    $comment ->comment = $request->comment;
    $comment-> save();
    return redirect('home');
}
public function deleteTweet(Request $request){
    $tweet = Tweet::find($request->tweet_id);
    if($tweet){
        Tweet::destroy($request->tweet_id);
    }
    return  redirect('home');
}
public function delete($id){
    $user = Auth::user();
    Comment::where('id',$id)->delete();
    return redirect('home');
}
public function editTweet(Request $request){
    $tweet =Tweet::find($request->tweet_id);
    $tweet ->tweet = $request->tweet;
    $tweet -> save();
    return redirect('home');
}
public function editTweetDisplay($id){
    $tweet =Tweet::find($id);
    return view('editTweet',compact('tweet'));
}
public function editComment(Request $request){
    $user = Auth::user();
    $comment = Comment::find($request->comment_id);
    $comment ->comment = $request->comment;
    $comment -> save();
    return redirect('home');
}
public function editCommentDisplay($id){
    $comment = Comment::find($id);
    return view('editComment',compact('comment'));
}
public function likeTweet(Request $request){
    $user = Auth::user();
    $tweetLike = new Tweetlike;
    $tweetLike ->user_id = $user->id;
    $tweetLike ->tweet_id = $request->tweet_id;
    $tweetLike ->like = $request->like;
    $tweetLike -> save();
    return redirect('home');
}
public function editProfile(Request $request){
    $currentUser = Auth:: User();
    $user = new User();
    $currentUserId = $currentUser->id;
    $user = $user->find($currentUserId);
    $user->name = $request->name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->telephone = $request->telephone;
    $user->gender = $request->gender;
    $user -> save();
    return redirect('home');
}
public function editProfileDisplay(){
    $currentUser = Auth:: User();
    $currentUserId = $currentUser->id;
    $user = new User();
    $user = $user->find($currentUserId);
    return view('editUserProfile',compact('user'));
}
public function getAllTweets(){
    $tweets =  Tweet::get();
    return new TweetResource($tweets);
}
public function getAllComments(){
    $comments = Comment::get();
    return new CommentResource($comments);
}
// public function getAllTweetLikes(){
//     $tweetLikes =  Tweetlike::get();
//     return new TweetlikeResource($tweetLikes);
//     }
public function getAllTweetsByNumber($number){
    $tweets = Tweet::limit($number)->orderBy('id','DESC')->get();
    return new TweetResource($tweets);
}
public function getAllTweetsByNumberFromStartPoint($number,$id){
    $tweets = Tweet::limit($number)->where("id", "<", $id)->orderBy('id','DESC')->get();
    return new TweetResource($tweets);
}
public function deleteTweetViaApi(Request $request){
    $tweet = Tweet::find($request->tweet_id);
    if($tweet){
        Tweet::destroy($request->tweet_id);
    }
}
// public function deleteCommentViaApi(Request $request,$id){
//     $user = Auth::user();
//     Comment::where('id',$id)->delete();
//
//     }

public function likeTweetViaApi(Request $request){
    $user = Auth::user();
    $user = new User();
    $tweetLike = new Tweetlike;
    $tweetLike ->user_id = $request->user_id;
    $tweetLike ->tweet_id = $request->tweet_id;
    $tweetLike ->like = $request->like;
    if ($tweetLike -> save()){
        return '{"success": "1"}';
    }
    else{
        return '{"success": "0"}';
    }
}
public function getAllTweetLikesApi(Request $request){
    // $id = Auth::user();
    $tweetLike = new Tweetlike;
    $previousTweetLike = Tweetlike::limit(1)->where("user_id", "=", $request->user_id)->where("tweet", "=", "1")->get();
       if(count($previousTweetLike) == 0){
           $tweetLike->user_id = $request->user_id;
           $tweetLike->tweet_id = $request->tweet_id;
           $tweetLike->like = $request->like;
        if( $tweetLike-> save()){
                 return'{"success" : "1"}';
            }
            else{
                return'{"success" : "0"}';
            }
        }

            else{
                $tweetLikeId = $previousTweetLike[0]["id"];
                $previousTweetLike = Tweetlike::find($tweetLikeId);
                $previousTweetLike->like = $request->like;
                $previousTweetLike->save();
                 return '("Liked!" : "1")';
             }
         }
    // public function index(Request $request, Tweet $tweet) {
    //      $tweet = $tweet->whereIn('user_id', $request->user()->following()
    //                        ->pluck('users.id')
    //                        ->push($request->user()->id))
    //                        ->with('user')
    //                        ->orderBy('created_at', 'desc')
    //                        ->take($request->get('limit', 10))
    //                        ->get();
    //
    //        return response()->json($tweets);
    //    }

     public function store(Request $request, Tweet $tweet){
           $newTweet = $request->user()->tweets()->create([
               'tweet' => $request->get('tweet')
           ]);

           return response()->json($tweet->with('user')->find($newTweet->id));
       }
public function followUserViaApi(){
    $user = Auth::user();
    $user = new User();
    $follower= new FollowerResource;
    $follower ->user_id = $request->user_id;
    $follower ->follower_id = $request->follower_id;
    $follower ->following = $request->following;
    if ($follower -> save()){
        return '{"success": "1"}';
    }
    else{
        return '{"success": "0"}';
    }
}

    public function getTweetComments($tweetId){
        $comments = Comment::where("tweet_id","=",$tweetId)->get();
        return new CommentResource($comments);
    }
    public function newCommentViaApi(Request $request){
        $comment = new Comment;
        $comment ->user_id = $request->user_id;
        $comment ->tweet_id = $request->tweet_id;
        $comment ->comment = $request->comment;
        if($request->comment){
            $comment -> save();
            return '{"success": "1"}';
        }
        else{
            return '{"success": "0"}';
        }
    }
    }
