<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use APP\UserDetail;
use App\Notifications\UserFollowed;

 class UsersController extends Controller{

     public function index()
     {
         $users = User::where('id', '!=', auth()->user()->id)->get();
         return view('users.index', compact('users'));

        // foreach ($users as $user) {
        //     echo $user->name;
        // }
        // $user = User::find(1);
        // $options['key'] = 'value';

        // return view('users.index', compact(['users' => $users],'users'));
    }
    public function __construct(){
          // $this->middleware('auth');
    }
    // public function show($username){
    //     $user = User::where('username', $username)->firstOrFail();
    //     return view('profile', ['username' => $username]);
    // }
    public function showUser(User $user){
        $user = Auth::user();
        $user = new User();
        $user = $user->find($id);
        $value = Cache::get('key');
        $tweets = $tweet->where('user_id', $user->id)->get();
        return view('user', compact('user','value'));
    }

    public function getUsers(){
        $users = User::all();
        $users = User::paginate(15);
        return view('index', compact('users'));
        }

        public function profile(){
                $user = Auth::user();
                $userDetail = new UserDetail;
                $userDetail = $userDetail->find($user->id);
                return view('profile',compact('user','userDetail'));
        }

public function update_avatar(Request $request){

     $request->validate([
         'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);

     $user = Auth::user();
     $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
     $request->avatar->storeAs('avatars', $avatarName);
     $user->avatar = $avatarName;
     $user->save();
     return back()
         ->with('success','You have successfully upload image.');

     }
// this works//////
    public function editProfileDisplay(Request $request){
       $currentUser = Auth:: User();
       $currentUserId = $currentUser->id;
       $user = new UserDetail;
       $user = $user->find($currentUserId);
       return view('edit-profile',compact('user', 'currentUser','currentUserId'));
     }
     // public function editProfileDisplay(){
     //     $currentUser = Auth:: User();
     //     $currentUserId = $currentUser->id;
     //     $user = new User();
     //     $user = $user->find($currentUserId);
     //     return view('editUserProfile',compact('user'));
     // }
// this works////
    public function editProfile(Request $request){
      $currentUser = Auth::user();
      $userDetail = new UserDetail;
      $currentUserId = $currentUser->id;
      $userDetail = $userDetail->find($currentUserId);
      $userDetail->first_name = $request->first_name;
      $userDetail->last_name = $request->last_name;
      $userDetail->username = $request->email;
      $userDetail->gender = $request->gender;
      $userDetail->phone = $request->phone;
      $userDetail->dob = $request->dob;
      $userDetail->country = $request->country;
      $userDetail -> save();
      // return redirect('profile');
      return back()
          ->with('success','You have successfully updated your details.');
     }

    public function userFollowers(){
         var_dump("userFollowers");
    }

   public function getOtherUser($id, $name){
        var_dump("other user " . $id . " " . $name);
    }

    public function user(){
       $users = DB::select('select * from users where active = ?', [1]);
       return view('users.index', ['users' => $users]);
    }

    public function show(User $user){
         $user = Auth::user();
         $user = new User();
         $followers = $user->followers;
         $followings = $user->following;
          return view('user', compact('user'));
    }
    // public function follow(Request $request, User $user){
    //     if($request->user()->canFollow($user)) {
    //        $request->user()->following()->attach($user);
    //     }
    //       return redirect()->back();
    //   }
    // public function unFollow(Request $request, User $user){
    //     if($request->user()->canUnFollow($user)) {
    //         $request->user()->following()->detach($user);
    //     }
    //     return redirect()->back();
    // }
    //
    // public function unFollow(User $user ){
    //       $user = User::find($user);
    //       if(! $user) {
    //
    //      return redirect()->back()->with('error', 'User does not exist.');
    //  }
     //
     // $user->follower()->detach(auth()->user()->id);
     // return redirect()->back()->with('success', 'Successfully unfollowed the user.');
     // }
//     public function followUser(User $user){
//      $user = User::find($user);
//      if(! $user) {
//
//         return redirect()->back()->with('error', 'User does not exist.');
//     }
// }
public function follow(User $user)
 {
     $follower = auth()->user();
     if ($follower->id == $user->id) {
         return back()->withError("You can't follow yourself");
     }
     if(!$follower->isFollowing($user->id)) {
         $follower->follow($user->id);

         // sending a notification
         $user->notify(new UserFollowed($follower));

         return back()->withSuccess("You are now friends with {$user->name}");
     }
     return back()->withError("You are already following {$user->name}");
 }

 public function unfollow(User $user)
 {
     $follower = auth()->user();
     if($follower->isFollowing($user->id)) {
         $follower->unfollow($user->id);
         return back()->withSuccess("You are no longer friends with {$user->name}");
     }
     return back()->withError("You are not following {$user->name}");
 }

 public function notifications()
 {
     return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
 }

}
