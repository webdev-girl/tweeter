<?php

namespace App\Http\Controllers;


use Auth;
use App\Tweets;
use App\TweetLike;
use App\Comments;
use App\User;
use App\Follower;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        $user = Auth::user();
        $comment = new Comments;
        $comment = $comment->get();
        $comment = Comments::limit(10)->get();
        $comment = $comment->where('user_id', $user->id)->get();
        return view('home',compact('user','comment'));
  }
   public function show($id){
        $tweet = Tweets::find($id)->comment;
        return view('home', compact('tweets'));
    }
///////this works
    public function saveComment(Request $request){
        // die("Test");
        $user = Auth::user();
        // $user= user::findOrFail($id);
        $comment = new Comments;
        $comment ->user_id = $user->id;
        $comment ->tweet_id = $request->tweet_id;
        $comment ->comment = $request->comment;
        $comments = Comment::orderBy('created_at','desc')->get();
        $comment-> save();
         return redirect('home');

        // return view('home', compact('comments','tweet_id','user_id'));
        }
/////// this works//
    public function deleteComment(Request $request) {
         $comment = Comments::find($request->comment_id);
         if($comment){
        Comments::destroy($request->comment_id);
        }
           return redirect('home');
           // return back()
         // ->with('success',' Successfully deleted!!.');
     }
     // this works
     public function editComment(Request $request){
         $comment = Comments::find($request->id);
         $comment = Comments::find($request->comment_id);
         $comment ->comment = $request->comment;
         $comment ->save();
            return redirect('home');
         // var_dump($tweet);die();
        }

    public function editCommentDisplay(Request $request, $id){
         $comment = new Comments;
         $comment = Comments::find($id);
        return view('edit-comment', compact('comment'));
    }

}
