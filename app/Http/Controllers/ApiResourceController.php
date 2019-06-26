<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Tweets;
use App\Tweetlikes;
use App\Comments;
use App\Followers;
use Auth;
use DB;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Tweets as TweetsResource;
use App\Http\Resources\Tweetlikes as TweetlikesResource;
use App\Http\Resources\Comments as CommentsResource;
use App\Http\Resources\FollowersResource as FollowersResource;
class ApiResourceController extends Controller
{

// ///important
    public function getAllTweets(){
        $tweets = Tweets::get();
        return new TweetsResource($tweets);
    }
////important    //
    public function getAllTweetsByNumber($number){
        $tweets = Tweets::limit($number)->get();
        return new TweetsResource($tweets);
   }
   public function getAllUsers(){
        $users = User::get();
        return new UserResource($users);
    }

    public function getSaveTweets($number){
         $tweets = Tweets::limit($number)->orderBy('id','DESC')->get();
        return new TweetsResource($tweets);
    }
    public function getAllTweetLikes(){
        $tweetLikes = Tweetlikes::get();
                return new TweetlikesResource($tweetLikes);
    }

    public function getAllComments(){
        $comments = Comments::get();
        return new CommentsResource($comments);
    }



                    public function getAllTweetsByNumberFromStartPoint($number, $id){
                        $tweets = Tweets::limit($number)->where("id", ">", $id)->get();
                        return new TweetsResource($tweets);
                    }
                    public function getAllTweetsByNumberFromStartPoint($number,$id){
                         $tweets = Tweets::limit($number)->where("id", "<", $id)->orderBy('id','DESC')->get();
                         return new TweetsResource($tweets);
                     }
// /////important
    public function getAllTweetsByNumberFromStartPoint(Request $request, $number, $id){
        $tweets = Tweet::limit($number)->where("id", "<", $id)->orderBy('id','DESC')->get();
        $tweetsExtended = [];
        $tweetLike = new TweetLike;

        foreach($tweets as $tweet){
            $tweetId = $tweet["id"];
            $tweetLikes = TweetLikes::limit(1)->where("tweet_id","=", $tweetId)->where("user_id", "=", $request->user_id)->where("like", "=", "1")->get();
            $likedByUser = 0;

               If(isset($tweetLikes[0]["like"])){
                    $likedByUser = $tweetLikes[0]["like"];
                }
                    $tweet["liked_by_user"] = $likedByUser;
                    $totalTweetsCount = TweetLikes::distinct("user_id")->where("tweet_id", "=", $tweetId)->where("like", "=", "1")->get();
                    $tweet["number_of_likes"] = count($totalTweetsCount);
                    $tweetsExtended[] = $tweet;
                }
                    $tweets = $tweetsExtended;
                   return new TweetsResource($tweets);
            }
// important


    public function getTweetComments($tweetId){
        $comments = Comments:: where('tweet_id', '=', $tweetId)->get();
        return new CommentsResource($comments);
    }
   public function newCommentViaApi(request $request){
       $comment = new Comments;
       $comment->user_id = $request->user_id;
       $comment->tweet_id = $request->tweet_id;
       $comment->comment = $request->comment;
       if ($request->comment) {
           $comment->save();
           return '{"success" : "1"}';
       }else {
           return '{"success" : "0"}';
       }
   }

    public function likeTweetViaApi(request $request){

        $tweetLike = new Tweetlikes;
        $tweetLike->user_id = $request->user_id;
        $tweetLike->tweet_id = $request->tweet_id;
        $tweetLike->like = $request->like;
        $tweetLike->save();
        if ($tweetLike->save()){
            return '{"success": "1"}';
        }else {
            return '{"success": "0"}';
       }
    }

    public function likeTweetViaApi(Request $request){
        $tweetlike = new Tweetlikes;
        $previousTweetLike = Tweetlikes::limit(1)->where("user_id", "=", $request->user_id)->where("tweet", "=", "0")->get();
             if(count($previousTweetLike) == 0){
                 $tweetLike->user_id =$request->user_id;
                 $tweetLike->tweet_id = $request->tweet_id;
                 $tweetLike->like = $request->like;
              if($tweetLike->save()){
                       return'{"success" : "1"}';
                  }
                  else{
                      return'{"success" : "0"}';
                   }
               }
                    else{
                          $tweetLikeId = $previousTweetLike[0]["id"];
                          $previousTweetLike = Tweetlikes::find($tweetLikeId);
                          $previousTweetLike->like = $request->like;
                          $previousTweetLike->save();
                           return'{"success" : "1"}';
                   }
               }

            // ///////// this works ////////
    public function deleteTweetViaApi(Request $request){
        $tweet = Tweet::find($request->tweet_id);
           if($tweet){
               Tweet::destroy($request->tweet_id);
             }
                return  redirect('home');
             }

                public function deleteCommentViaApi($id){
                    $user = Auth::user();
                    Comment::where('id',$id)->delete();
                    return redirect('home');
                }
    public function followUserViaApi(){
        $user = Auth::user();
        $user = new User();
        $follower = new FollowersResource;
        $follower ->user_id = $request->user_id;
        $follower ->follows_id = $request->follows_id;
        $follower ->following = $request->following;
        if ($follower -> save()){
             return '{"success": "1"}';
        }
        else {
        return '{"success": "0"}';
        }
     }
}
