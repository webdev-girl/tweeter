<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tweets;
use App\TweetLike;
use App\Comments;
use App\Follower;
use Auth;
use DB;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Tweet as TweetResource;
use App\Http\Resources\TweetLike as TweetLikeResource;
use App\Http\Resources\Comment as CommentResource;
class TweetController extends Controller
{


        // public function index() {

    //         $user = Auth::user();
    //         $user_id = Auth::user()->id;
    //
    //         $user = new User;
    //         $users = $user;
                // $name = new User;
                // $names = $name;
    //         $tweet = new Tweets;
    //         $editTweet = new Tweets;
    //         $tweetLike = new TweetLike;
    //         $tweets = $tweet->where('user_id', $user->id)->orderBy('created_at','desc')->get();
    //
    //         $potentialFollowers = $users = $user->get();
    //         // $follower = $follower->where("user_id",$user->id)->where("following", 1)->get(array('id'))->toArray();
    //         $tweet = Tweets::orderBy('created_at','desc')->get();
    //         $tweetCollection = array();
    //         $count = count($tweets);
    //
    //         $currentUserId = $user->id;
    //         $names = $name->where('id', '!=', $currentUserId)->get();
    //         $names = User::where('id', '!=', $currentUserId)->simplePaginate(75);
    //         $data = Tweets::orderBy('id')->paginate(3);
    //
    //     foreach ($tweets as $tweet) {
    //          $newTweet = $tweet;
    //          $newTweet['comments'] = $comments;
    //          $comments = Tweets::find($tweet->id)->comments;
    //          $newTweet['liked'] = false;
    //          $tweetLike = \DB::table('TweetLike')->where('user_id', $user->id)->where('tweet_id', $tweet->id)->orderBy('created_at','DESC')->first();
    //
    //     if(isset($tweetLike->like) && ($tweetLike->like == "1")){
    //          $newTweet['liked'] = true;
    //          }
    //          $newTweet['user'] = Tweets::find($tweet->id)->user;
    //
    //     if($user->id == $tweet->user_id){
    //          $newTweet['has_permissions'] = 1;
    //           }
    //
    //     if($user->id == $tweet->user_id){
    //         $newTweet['can_delete'] = 1;
    //         }
    //         $tweetCollection[] = $newTweet;
    //          }
    //         $tweets = $tweetCollection;
    //         // $likes = DB::table('tweet_likes')->where('user_id', '=', $user->id)->get();
    //         return view('home', compact('user','tweet','tweets', 'names'));
    //        }
    //
    //     public function show($username){
    //         $users = User::where('username', $username)->firstOrFail();
    //          return view('home','$users', ['username' => $username]);
    //     }
    //
    // ////////this works
    //     public function saveTweet(Request $request){
    //         $user = Auth::user();
    //         $tweet = new Tweets;
    //         $tweet->user_id = $user->id;
    //         $tweet->tweet = $request->tweet;
    //         $tweet-> save();
    //         return redirect('home');
    //     }
    // ///////this works
    //     public function deleteTweet(Request $request) {
    //         $tweet = Tweets::find($request->tweet_id);
    //         if($tweet){
    //         Tweet::destroy($request->tweet_id);
    //         }
    //         return redirect('home');
    //            return back()
    //                ->with('success','Successfully deleted!!.');
    //     }
    // /// this works
    //     public function likeTweet(Request $request){
    //         $user = Auth::user();
    //         $tweetLike = new TweetLike;
    //         $tweetLike->user_id = $user->id;
    //         $tweetLike->tweet_id = $request->tweet_id;
    //         $tweetLike->like = $request->like;
    //         $tweetLike-> save();
    //          return redirect('home');
    //         }
    //
    //     public function unLikeTweet(Request $request){
    //         $user = Auth::user();
    //         $tweetUnlike = TweetUnLike::get();
    //         $tweetUnLike->user_id = $user_id;
    //         $tweetUnLike->tweet_id = $request->tweet_id;
    //         $tweetUnLike->like = $request->like;
    //         return redirect('home');
    //      }
    //
    //     public function delete($id){
    //         $user = Auth::user();
    //         Comments::where('id', $id)->delete();
    //           return redirect('home');
    //     }
    //
    // //// this works
    //     public function editTweet(Request $request){
    //         $tweet = Tweets::find($request->tweet_id);
    //         $tweet->tweet = $request->tweet;
    //         $tweet->save();
    //          return redirect('home');
    //          return view('home', compact('tweet'));
    //      }
    // //// this works
    //     public function editTweetDisplay(Request $request, $id){
    //         $tweet = new Tweets;
    //         $tweet = Tweets::find($id);
    //         return view('edit-tweet', compact('tweet'));
    //     }
    //
    //     public function getAllUsers(){
    //         $users = User::get();
    //         return new UserResource($users);
    //     }
    //    public function getSaveTweets($number){
    //        $tweets = Tweets::limit($number)->orderBy('id','DESC')->get();
    //        return new TweetResource($tweets);
    //         }
    //
    //     public function getAllTweets(Request $request){
    //         $tweets =  Tweets::get();
    //         $id = Auth::user();
    //         $tweets = $tweet->where('user_id', $user->id)->orderBy('created_at','desc')->get();
    //         return new TweetResource($tweets);
    //     }
    //
    //     public function getAllComments(){
    //         $comments =  Comments::get();
    //         return new CommentResource($comments);
    //     }
    //     public function getAllTweetLikes(){
    //         $tweetLikes =  Tweetlike::get();
    //         return new TweetlikeResource($tweetLikes);
    //         }
    //     public function getAllTweetsByNumber($number){
    //         $tweet =  Tweets::limit($number)->orderBy('id','DESC')->get();
    //         return new TweetResource($tweet);
    //     }
    //
    //     public function getAllTweetsByNumberFromStartPoint(Request $request, $number, $id){
    //         $tweets =  Tweets::limit($number)->where("id", "<", $id)->orderBy('id','DESC')->get();
    //         $tweetsExtended = [];
    //         $tweetLike = new TweetLike;
    //
    //      foreach($tweets as $tweet){
    //          $tweetId = $tweet["id"];
    //          $tweetLikes = TweetLike::limit(1)->where("tweet_id","=", $tweetId)->where("user_id", "=", $request->user_id)->where("like", "=", "1")->get();
    //          $likedByUser = 0;
    //
    //           If(isset($tweetLikes[0]["like"])){
    //                  $likedByUser = $tweetLikes[0]["like"];
    //             }
    //                   $tweet["liked_by_user"] = $likedByUser;
    //                   $totalTweetsCount = TweetLike::distinct("user_id")->where("tweet_id", "=", $tweetId)->where("like", "=", "1")->get();
    //                   $tweet["number-of_likes"] = count($totalTweetsCount);
    //                   $tweetsExtended[] = $tweet;
    //               }
    //                   $tweets = $tweetsExtended;
    //                  return new TweetResource($tweets);
    //             }
    //
    //     public function likeTweetViaApi(Request $request){
    //         $id = Auth::user();
    //         $user = Auth::user();
    //         $user = new User();
    //         $tweetLike = new Tweetlike;
    //         $tweetLike ->user_id = $request->user_id;
    //         $tweetLike ->tweet_id = $request->tweet_id;
    //         $tweetLike ->like = $request->like;
    //         if ($tweetLike -> save()){
    //             return '{"success": "1"}';
    //         }
    //         else{
    //             return '{"success": "0"}';
    //         }
    //     }
    //
    //     public function unLikeTweetViaApi(Request $request){
    //         $tweetUnlike = TweetUnLike::get();
    //         $previousTweetUnLike = TweetUnLike::limit(1)->where("user_id", "=", $request->user_id)->where("tweet", "=", "0")->get();
    //              if(count($previousTweetLike) == 0){
    //                  $tweetUnLike->user_id =$request->user_id;
    //                  $tweetUnLike->tweet_id = $request->tweet_id;
    //                  $tweetUnLike->like = $request->like;
    //               if( $tweetUnLike-> save()){
    //                        return'{"success" : "1"}';
    //                   }
    //                   else{
    //                       return'{"success" : "0"}';
    //                    }
    //                      return new TweetResource($tweetUnLike);
    //               }
    //
    //                       else{
    //                           $tweetLikeId = $previousTweetLike[0]["id"];
    //                           $previousTweetUnLike = TweetLike::find($tweetLikeId);
    //                           $previousTweetUnLike->like = $request->like;
    //                           $previousTweetUnLike->save();
    //                            return '("Liked!" : "0")';
    //                    }
    //                     return response()->json($data);
    //             }
    //
    //
    //     public function followUserViaApi(){
    //         $user = Auth::user();
    //         $user = new User();
    //         $follower= new FollowerResource;
    //         $follower ->user_id = $request->user_id;
    //         $follower ->follower_id = $request->follower_id;
    //         $follower ->following = $request->following;
    //         if ($follower -> save()){
    //             return '{"success": "1"}';
    //         }
    //         else{
    //             return '{"success": "0"}';
    //         }
    //     }
    //     // public function getTweetComments($tweetId){
    //     //     // $user = User::find($id);
    //     //     $user = Auth::user();
    //     //     $comment = new Comments;
    //     //     $comment ->user_id = $request->user_id;
    //     //     $comment ->tweet_id = $request->tweet_id;
    //     //     $comment ->comment = $request->comment;
    //     //     $comment ->save();
    //     //     $comment = Comments::where("tweet_id","=",$tweetId)->get();
    //     //     return new CommentResource($comment);
    //     // }
    //     public function getTweetComments($tweetId){
    //     $comments = Comments:: where('tweet_id', '=', $tweetId)->get();
    //     return new CommentResource($comments);
    // }
    //     public function newCommentViaApi(Request $request){
    //         // $user = Auth::user();
    //         $comment = new Comments;
    //         $comment ->user_id = $request->user_id;
    //         $comment ->tweet_id = $request->tweet_id;
    //         $comment ->comment = $request->comment;
    //         if($request->comment){
    //             $comment -> save();
    //             return '{"success" : "1"}';
    //         }
    //         // return new CommentsResource($comment, $user);
    //
    //         else{
    //             return '{"success" : "0"}';
    //         }
    //     }
    // }

    public function index()
    {
     $users = new User;
     $follower = $users = $users->get();
     $user = Auth::user();
     $name = new User;
     $names = $name;
     $tweet = new Tweets;
     $tweets = $tweet->get();
     $comment = new Comments;
     $comments = $comment->get();
     $tweets = $tweet->where('user_id',$user->id)->orderBy('created_at','desc')->get();
     // $tweet = Tweet::orderBy('created_at','desc')->get();
     $tweetCollection = array();
     foreach ($tweets as $tweet) {
         $newTweet = $tweet;
         $comment = Tweets::find($tweet->id)->comment;
         $newTweet['liked'] = false;
         // $tweetLike = \DB::table('tweet_Likes')->where('user_id',$user->id)->where('tweet_id',$tweet->id)->orderBy('created_at','DESC')->first();
         $tweetLike = DB::table('tweet_likes')->where('user_id', '=', $user->id)->get();
         if(isset($tweetLike->like) && ($tweetLike->like == "1")){
             $newTweet['liked'] = true;
         }
         $newTweet['user'] = Tweets::find($tweet->id)->user;
         if($user->id == $tweet->user_id){
             $newTweet['has_permissions'] = 1;
         }
         $tweetCollection[] = $newTweet;
     }
     $tweets = $tweetCollection;

     return view('home',compact('tweets','user','name','names'));
 }

    public function saveTweet(Request $request){
     $this->middleware('auth');
     $user = Auth::user();
     $tweet = new Tweets;
     $tweet ->user_id = $user->id;
     $tweet ->tweets = $request->tweet;
     $tweet -> save();
     return redirect('home');
 }
 public function saveComment(Request $request){
     $user = Auth::user();
     $comment = new Comments;
     $comment ->user_id = $user->id;
     $comment ->tweet_id = $request->tweet_id;
     $comment ->comment = $request->comment;
     $comment-> save();
     return redirect('home');
 }
 public function deleteTweet(Request $request){
     $tweet = Tweets::find($request->tweet_id);
     if($tweet){
         Tweets::destroy($request->tweet_id);
     }
     return  redirect('home');
 }
 public function delete($id){
     $user = Auth::user();
     Comments::where('id',$id)->delete();
     return redirect('home');
 }
 public function editTweet(Request $request){
     $tweet =Tweets::find($request->tweet_id);
     $tweet ->tweet = $request->tweet;
     $tweet -> save();
     return redirect('home');
 }
 public function editTweetDisplay($id){
     $tweet =Tweets::find($id);
     return view('edit-tweet',compact('tweet'));
 }
 public function editComment(Request $request){
     $user = Auth::user();
     $comment = Comments::find($request->comment_id);
     $comment ->comments = $request->comment;
     $comment -> save();
     return redirect('home');
 }
 public function editCommentDisplay($id){
     $comment =Comments::find($id);
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
     $tweets =  Tweets::get();
     return new TweetResource($tweets);
 }
 public function getAllComments(){
     $comments =  Comments::get();
     return new CommentResource($comments);
 }
 public function getAllTweetLikes(){
     $tweetLikes =  Tweetlike::get();
     return new TweetlikeResource($tweetLikes);
     }
 public function getAllTweetsByNumber($number){
     $tweets =  Tweets::limit($number)->orderBy('id','DESC')->get();
     return new TweetResource($tweets);
 }
 public function getAllTweetsByNumberFromStartPoint($number,$id){
     $tweets =  Tweets::limit($number)->where("id", "<", $id)->orderBy('id','DESC')->get();
     return new TweetResource($tweets);
 }
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
     $comments = Comments::where("tweet_id","=",$tweetId)->get();
     return new CommentResource($comments);
 }
 public function newCommentViaApi(Request $request){
     $user = Auth::user();
     $comment = new Comments;
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


//         public function newCommentApi(request $request){
//             $commentApi = new Comments;
//             $commentApi->user_id = $request->user_id;
//             $commentApi->tweet_id = $request->tweet_id;
//             $commentApi->comment = $request->comment;
//             if ($request->comment) {
//                 $commentApi->save();
//                 return '{"success" : "1"}';
//             }else {
//                 return '{"success" : "0"}';
//         }
//     }
// }
    //
    //     public function store(){
    //         return view('home');
    //     }
    //     public function index(){
    //         $tweets = Tweets::limit(10)->get();
    //         $comments = Comments::limit(10)->get();
    //         $user = Auth::user();
    //         $user_id = Auth::user()->id;
    //         $names = new User;
    //         $names = $name->where('id', '!=', $currentUserId)->get();
    //         $tweets = Tweets::orderBy('created_at', 'DESC')->get();
    //         $tweetsCollection = array();
    //         foreach ($tweets as $tweet){
    //         $newTweet = $tweet;
    //         $newTweet['comments'] = Tweets::find($tweet->id)->user;
    //         $newTweet['user'] = Tweets::find($tweet->id)->user;
    //         if($user->id == $tweet->user_id){
    //             $newTweet['has_permissions'] = 1;
    //         }
    //         $tweetCollection[] = $newTweet;
    //         $tweets = $tweetCollection;
    //     }
    //     return view('home', compact('user','tweets','comments','names','name'));
    //
    //
    // }
    //     public function show($id){
    //         $tweet = Tweets::find($id)->Comments;
    //         return view('home', compact('tweets'));
    //     }
    //     // public function show2(Tweet $tweet){
    //     //     return $tweet;
    //     // }
    //     public function create(request $request){
    //         $user = Auth::user();
    //         $Tweetsmodel = new Tweets;
    //         $Tweetsmodel->user_id = $user->id;
    //         $Tweetsmodel->tweet = $request->tweet;
    //         $Tweetsmodel->save();
    //         return redirect('home');
    //         $tweets = Tweets::orderBy('created_at','desc')->get();
    //         return view('home', compact('tweets'));
    //     }
    //     public function create_comment(request $request){
    //         $user = Auth::user();
    //         $commentsModel = new Comments;
    //         $commentsModel->user_id = $user->id;
    //         $commentsModel->tweet_id = $request->tweet->id;
    //         $commentsModel->comments = $request->comment;
    //         $commentsModel->save();
    //         return redirect('home');
    //         $comments = Comments::orderBy('created_at','desc')->get();
    //         return view('home', compact('comments','tweet_id','user_id'));
    //     }
    //     public function destroy(request $request){
    //         $Tweetsmodel = Tweets::find($request->tweet);
    //         $Tweetsmodel->delete();
    //         Session::flash('message', 'successfully removed');
    //         return Redirect::to('home');
    //     }
    //     public function editTweetDisplay($id){
    //         $Tweetsmodel = Tweets::find($id);
    //         return view('editTweet', compact('tweets'));
    //     }
    //     public function editTweet(request $request){
    //         $user = Auth::user();
    //         $Tweetsmodel = Tweets::find($request->tweet_id);
    //         $Tweetsmodel->tweet = $request->tweet;
    //         $Tweetsmodel->save();
    //         return redirect('home');
    //     }
    //     public function follow(request $request){
    //         $user = Auth::user();
    //         $Tweetsfollowmodel = new following;
    //         $Tweetsfollowmodel->user_id = $user->id;
    //         $Tweetsfollowmodel->followers_id = $request->followers_id;
    //         $Tweetsfollowmodel->follow = $request->follow;
    //         $Tweetsfollowmodel->save();
    //         foreach ($following as $follow) {
    //             $newfollower = $follower;
    //             $newfollower['follow'] = false;
    //             $following = \DB::table('following')->where('user_id', $user->id)->where('followers_id', $followers->id)->orderBy('updated_at', 'desc')->first();
    //             if(isset($following->follow)&&($following->follow == "1")){
    //                 $newfollower['follow'] = true;
    //             }
    //         }
    //        return view('home', compact('user','follow'));
    //     }
    //     public function following(request $request){
    //         $user = Auth::user();
    //         $Tweetslikemodel = new Tweetlike;
    //         $Tweetslikemodel->user_id = $user->id;
    //         $Tweetslikemodel->tweet_id = $request->tweet_id;
    //         $Tweetslikemodel->like = $request->like;
    //         $Tweetslikemodel->save();
    //         return redirect('home');
    //         foreach ($tweets as $tweet) {
    //             $newTweet = $tweet;
    //             $newTweet['liked'] = false;
    //             $tweetlike = \DB::table('Tweetlikes')->where('user_id', $user->id)->where('tweet_id', $tweet->id)->orderBy('created_at', 'desc')->first();
    //             if(isset($tweetlike->like)&&($tweetlike->like == "1")){
    //                 $newTweet['liked'] = true;
    //             }
    //         }
    //     }
    //     public function getAllTweets(){
    //         $tweets = Tweets::get();
    //         return new TweetResource($tweets);
    //     }
    //     public function getAllTweetsByNumber($number){
    //         $tweets = Tweets::limit($number)->get();
    //         return new TweetResource($tweets);
    //     }
    //     public function getAllTweetsByNumberFromStartPoint($number, $id){
    //         $tweets = Tweets::limit($number)->where("id", ">", $id)->get();
    //         return new TweetResource($tweets);
    //     }
    //     public function likeTweetViaApi(request $request){
    //         $Tweetslikemodel = new Tweetlike;
    //         $Tweetslikemodel->user_id = $request->$user_id;
    //         $Tweetslikemodel->tweet_id = $request->tweet_id;
    //         $Tweetslikemodel->like = $request->like;
    //         $Tweetslikemodel->save();
    //         if ($Tweetslikemodel->save()) {
    //             return '{"success" : "1"}';
    //         }else {
    //             return '{"success" : "0"}';
    //         }
    //     }
    //     public function getTweetComments($tweetId){
    //         $comments = Comments:: where('tweet_id', '=', $tweetId)->get();
    //         return new CommentResource($comments);
    //     }
    //     public function newCommentApi(request $request){
    //         $commentApi = new Comments;
    //         $commentApi->user_id = $request->user_id;
    //         $commentApi->tweet_id = $request->tweet_id;
    //         $commentApi->comment = $request->comment;
    //         if ($request->comment) {
    //             $commentApi->save();
    //             return '{"success" : "1"}';
    //         }else {
    //             return '{"success" : "0"}';
    //         }
    //     }
    //     public function editprofile(request $request){
    //         $currentUser - Auth::user();
    //         $user = $user->find($user_Id);
    //         $Edit->first_name = $request->first_name;
    //         $Edit->last_name = $request->last_name;
    //         $Edit->tweet_id = $request->tweet_id;
    //         $Edit->like = $request->like;
    //         $Edit->save();
    //         return redirect('profile');
    //     }
    //     //last step create form
    // }
