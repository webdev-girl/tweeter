<?php

namespace App\Http\Controllers;

use Auth;
use App\Tweet;
use App\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class CommentsController extends Controller
{
    public function __construct()
    {

     }
    public function index() {
        $user = Auth::user();
        $comment = new Comment;
        $comment = Comment::limit(10)->get();
        $comment = $comment->where('user_id', $user->id)->get();
        return view('home',compact('user','comment'));
  }

    public function show($id){
        $tweet = Tweet::find($id)->comments;
        return view('home',compact('tweet'));
    }
///// this works//

    public function deleteComment(Request $request) {
        $comment = Comment::find($request->comment_id);
        if($comment){
            Comment::destroy($request->comment_id);
             }
             return redirect('home');
             // return back()
              // ->with('success',' Successfully deleted!!.');
          }
/// //// ///// //// ////// // this works

    public function editComment(Request $request){
        $comment = Comment::find($request->id);
        $comment = Comment::find($request->comment_id);
        $comment ->comment = $request->comment;
        $comment ->save();
           return redirect('home');
        // var_dump($tweet);die();
     }

    public function editCommentDisplay(Request $request, $id){
         $comment = new Comment;
         $comment = Comment::find($id);
        return view('edit-comment', compact('comment'));
    }


///////this works
    public function saveComment(Request $request){
        // die("Test");
        $user = Auth::user();
        $comment = new Comment;
        $comment ->user_id = $user->id;
        $comment ->tweet_id = $request->tweet_id;
        $comment ->comment = $request->comment;
        $comment->save();
        return redirect('home');
        }

    public function store(Request $request, $id){
        $comment = new Comment;
        $comment->gif_comment = $request->gif_comment;
        $comment->body = $request->get('comment_body');
        if($comment->gif_comment) {
            $comment->body = $request->get('giph_search');
        }
        $comment->user_id = Auth::id();
        $comment->tweet_id = $id;
        if($comment->save()){
            return redirect('/tweets/' . $id);
        } else {
            return back();
        }
}
    public function edit($tweet_id, $comment_id){
        $comment = Comment::find($comment_id);
        return view('home', compact('comment'));
}
    public function update(Request $request, $tweet_id, $comment_id){
        $comment = Comment::find($comment_id);
        $comment->user_id = Auth::id();
        $comment->body = $request->body;
        if($comment->save()){
            return redirect('/tweets/' . $tweet_id . '/');
        } else {
            return back();
        }
}
    public function destroy ($tweet_id, $comment_id)
    {
        $delete = Comment::destroy ($comment_id);
            if ($delete){
                return redirect('/tweets/' . $tweet_id . '/');
            } else {
                return back();
            }
        }
 }
