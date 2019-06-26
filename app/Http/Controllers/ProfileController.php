<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use APP\UserDetail;
use Auth;
class ProfileController extends Controller
{
    public function __construct()
    {
          // $this->middleware('auth');
    }

    public function show($username){
        $user = User::where('username', $username)->firstOrFail();
        return view('profile', ['username' => $username]);
    }

    public function profile(){
            $user = Auth::user();
            $userDetail = new UserDetail;
            $userDetail = $userDetail->find($user->id);
            return view('profile',compact('user','userDetail'));
    }
    //
    // public function update_avatar(Request $request){
    //
    //  $request->validate([
    //      'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //  ]);
    //
    //  $user = Auth::user();
    //  $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
    //  $request->avatar->storeAs('avatars', $avatarName);
    //  $user->avatar = $avatarName;
    //  $user->save();
    //  return back()
    //      ->with('success','You have successfully upload image.');
    //
    //  }
    // // this works//////
    // public function editProfileDisplay(Request $request){
    //    $currentUser = Auth:: User();
    //    $currentUserId = $currentUser->id;
    //    $user = new UserDetail;
    //    $user = $user->find($currentUserId);
    //    return view('edit-profile',compact('user', 'currentUser','currentUserId'));
    //  }
    // // this works////
    // public function editProfile(Request $request){
    //   $user = new User();
    //   $currentUser = Auth::user();
    //   $userDetail = new UserDetail;
    //   $currentUserId = $currentUser->id;
    //   $userDetail = $userDetail->find($currentUserId);
    //   $userDetail->first_name = $request->first_name;
    //   $userDetail->last_name = $request->last_name;
    //   $userDetail->username = $request->email;
    //   $userDetail->gender = $request->gender;
    //   $userDetail->phone = $request->phone;
    //   $userDetail->dob = $request->dob;
    //   $userDetail->country = $request->country;
    //   $userDetail -> save();
    //   // return redirect('profile');
    //   return back()
    //       ->with('success','You have successfully updated your details.');
    //  }

     public function suggest(){
         //get an array of ID's of people user already follows
         $following = Auth::user()->following->pluck('id')->toArray();
         //add current user to following list so they aren't suggested
         // to follow themselves
         array_push($following, Auth::id());
         $suggested = User::whereNotIn('id',$following)->inRandomOrder()->limit(10)->get();
         return view('profiles.suggested',['users' => $suggested]);
     }
     public function followers($id){
         $user = User::with('followers')->find($id);
         return view('profiles.followers', compact('user'));
     }
     public function following($id){
         $user = User::with('followers')->find($id);
         return view ('profiles.following', compact('user'));
     }
     public function follow(Request $request, $user_id){
         $follow = DB::table('followers')->insert([
             'user_id' => $user_id,
             'follower_id' => Auth::id()
         ]);
         if($follow){
             $user = User::find($id);
             $request->session()->flash('message','You are now following ' . $user->name);
             return redirect(url()->previous());
         }
         dd('Unspecified error');
     }
     public function unfollow(Request $request, $user_id){
         $delete = DB::table('followers')->where([
             ['user_id', $user_id],
             ['follower_id', Auth::id()]
         ])->delete();
         if($delete){
             $user = User::find($id);
             $request->session()->flash('message', 'You are not following ' . $user->name . ' anymore, Thankfully!');
             return redirect(url()->previous());
         }
         dd('Unspecified error');
     }

}
