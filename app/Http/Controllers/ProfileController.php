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
            $userDetail = new UserDetail();
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
       $user = new UserDetail();
       $user = $user->find($currentUserId);
       return view('edit-profile',compact('user', 'currentUser','currentUserId'));
     }
    // this works////
    public function editProfile(Request $request){
      $user = new User();
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
     // public function upload(ImageRequest $request){
    //
    //     $request->user()->avatar = $request->image;
    //     $request->user()->save();
    //     return response( content: null, status: 200);
    // }
}
