<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

 class UserController extends Controller
{
    public function show(User $user)
        {
        return view('user', compact('user'));
        }

    public function follow(Request $request, User $user){
        if($request->user()->canFollow($user)) {
            $request->user()->following()->attach($user);
        }
        return redirect()->back();
    }
    public function unFollow(Request $request, User $user){
       if($request->user()->canUnFollow($user)) {
           $request->user()->following()->detach($user);
        }
           return redirect()->back();
       } 
//     public function index($id){
//
//     $user = new User();
//     $profilefollowers = $users = $uset->get();
//     // $user = $user->find($id);
//     $tweet = new Tweet;
//     $tweets = $tweet->get();
//     $tweetsCollection = array();
//     foreach($tweets as $tweet){
//     $newTweet = $tweet;
//     $comments = Tweet::find($tweet->id)->comments;
//     $newTweet['comments'] = $comments;
//     $tweetsCollection[] = $newTweet;
// }
//
//     return view('profilepage',compacts('user','profilefollowers','tweets'));
// }
//
//    public function followUser(User $user)
//    {
//      $user = User::find($profileId);
//      if(! $user) {
//
//         return redirect()->back()->with('error', 'User does not exist.');
//     }
//
//    $user->followers()->attach(auth()->user()->id);
//         return redirect()->back()->with('success', 'Successfully followed the user.');
//    }
//
//    public function unFollowUser(User $user)
//    {
//          $user = User::find($profileId);
//          if(! $user) {
//
//         return redirect()->back()->with('error', 'User does not exist.');
//     }
//
//     $user->followers()->detach(auth()->user()->id);
//     return redirect()->back()->with('success', 'Successfully unfollowed the user.');
//     }
//
// public function show(User $user)
// {
//     $user = Auth::user();
//     $user = new User();
//     $user = User::find($userId);
//     $user = $user->find($id);
//     $value = Cache::get('key');
//     $tweets = $tweet->where('user_id', $user->id)->get();
//     $followers = $user->followers;
//     $followings = $user->followings;
//     return view('home',compact('user','follower','followings','value'));
//     }
//     public function editProfileDisplay(){
//         $currentUser = Auth:: User();
//         $currentUserId = $currentUser->id;
//         $user = new User();
//         $user = $user->find($currentUserId);
//         return view('editUserProfile',compact('user'));
//     }
//
//
 }
