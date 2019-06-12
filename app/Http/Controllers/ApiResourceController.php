<!-- 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\User;
// use App\Tweet;
// use App\TweetLikes;
// use App\Comments;
// use App\Follower;
// use Auth;
// use DB;
// use App\Http\Resources\User as UserResource;
// use App\Http\Resources\Tweet as TweetResource;
// use App\Http\Resources\TweetLike as TweetLikeResource;
// use App\Http\Resources\Comment as CommentResource;
// class ApiResourceController extends Controller
// {
//
// // ///important
//     public function getAllTweets(){
//         $tweets = Tweet::get();
//         return new TweetResource($tweets);
//     }
// ////important    //
//     public function getAllTweetsByNumber($number){
//         $tweets = Tweet::limit($number)->get();
//         return new TweetResource($tweets);
//    }
//    public function getAllUsers(){
//         $users = User::get();
//         return new UserResource($users);
//     }
//
//     public function getSaveTweets($number){
//          $tweets = Tweet::limit($number)->orderBy('id','DESC')->get();
//         return new TweetResource($tweets);
//     }
//     public function getAllTweetLikes(){
//         $tweetLikes = TweetLikes::get();
//                 return new TweetLikeResource($tweetLikes);
//     }
//
//     // public function getAllComments(){
//     //     $comments = Comments::get();
//     //     return new CommentResource($comments);
//     // }
//
//
//
//                     // public function getAllTweetsByNumberFromStartPoint($number, $id){
//                     //     $tweets = Tweets::limit($number)->where("id", ">", $id)->get();
//                     //     return new TweetResource($tweets);
//                     // }
//                     // public function getAllTweetsByNumberFromStartPoint($number,$id){
//                     //      $tweets = Tweets::limit($number)->where("id", "<", $id)->orderBy('id','DESC')->get();
//                     //      return new TweetResource($tweets);
//                     //  }
// // /////important
//     public function getAllTweetsByNumberFromStartPoint(Request $request, $number, $id){
//         $tweets = Tweet::limit($number)->where("id", "<", $id)->orderBy('id','DESC')->get();
//         $tweetsExtended = [];
//         $tweetLike = new TweetLike;
//
//         foreach($tweets as $tweet){
//             $tweetId = $tweet["id"];
//             $tweetLikes = TweetLike::limit(1)->where("tweet_id","=", $tweetId)->where("user_id", "=", $request->user_id)->where("like", "=", "1")->get();
//             $likedByUser = 0;
//
//                If(isset($tweetLikes[0]["like"])){
//                     $likedByUser = $tweetLikes[0]["like"];
//                 }
//                     $tweet["liked_by_user"] = $likedByUser;
//                     $totalTweetsCount = TweetLike::distinct("user_id")->where("tweet_id", "=", $tweetId)->where("like", "=", "1")->get();
//                     $tweet["number_of_likes"] = count($totalTweetsCount);
//                     $tweetsExtended[] = $tweet;
//                 }
//                     $tweets = $tweetsExtended;
//                    return new TweetResource($tweets);
//             }
// // important
//
//
//     public function getTweetComments($tweetId){
//         $comments = Comments:: where('tweet_id', '=', $tweetId)->get();
//         return new CommentResource($comments);
//     }
//    public function newCommentViaApi(request $request){
//        $comment = new Comments;
//        $comment->user_id = $request->user_id;
//        $comment->tweet_id = $request->tweet_id;
//        $comment->comment = $request->comment;
//        if ($request->comment) {
//            $comment->save();
//            return '{"success" : "1"}';
//        }else {
//            return '{"success" : "0"}';
//        }
//    }
//
//     // public function likeTweetViaApi(request $request){
//     //
//     //     $tweetLike = new TweetLike;
//     //     $tweetLike->user_id = $request->user_id;
//     //     $tweetLike->tweet_id = $request->tweet_id;
//     //     $tweetLike->like = $request->like;
//     //     $tweetLike->save();
//     //     if ($tweetLike->save()){
//     //         return '{"success": "1"}';
//     //     }else {
//     //         return '{"success": "0"}';
//     //    }
//     // }
//
//     public function likeTweetViaApi(Request $request){
//         $tweetlike = new TweetLike;
//         $previousTweetLike = TweetLike::limit(1)->where("user_id", "=", $request->user_id)->where("tweet", "=", "0")->get();
//              if(count($previousTweetLike) == 0){
//                  $tweetLike->user_id =$request->user_id;
//                  $tweetLike->tweet_id = $request->tweet_id;
//                  $tweetLike->like = $request->like;
//               if($tweetLike->save()){
//                        return'{"success" : "1"}';
//                   }
//                   else{
//                       return'{"success" : "0"}';
//                    }
//                }
//                     else{
//                           $tweetLikeId = $previousTweetLike[0]["id"];
//                           $previousTweetLike = TweetLike::find($tweetLikeId);
//                           $previousTweetLike->like = $request->like;
//                           $previousTweetLike->save();
//                            return'{"success" : "1"}';
//                    }
//                }
//
//             // ///////// this works ////////
//     public function deleteTweetViaApi(Request $request){
//         $tweet = Tweet::find($request->tweet_id);
//            if($tweet){
//                Tweet::destroy($request->tweet_id);
//              }
//                 return  redirect('home');
//              }
//
//                 public function deleteCommentViaApi($id){
//                     $user = Auth::user();
//                     Comment::where('id',$id)->delete();
//                     return redirect('home');
//                 }
//     public function followUserViaApi(){
//         $user = Auth::user();
//         $user = new User();
//         $follower = new FollowerResource;
//         $follower ->user_id = $request->user_id;
//         $follower ->follower_id = $request->follower_id;
//         $follower ->following = $request->following;
//         if ($follower -> save()){
//              return '{"success": "1"}';
//         }
//         else {
//         return '{"success": "0"}';
//         }
//      }
// } -->
