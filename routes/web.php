<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('marketing', function (){
    return view('/marketing');
});
Route::get('/user', function () {
        return view('user');
});
Route::get('/edit-tweet', function () {
        return view('edit-tweet');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





// Route::get('user/api',[
// 	'as' => 'user.api',
// 	'uses' => 'API\UserApiController@index'
// ]);
// Route::get('users',[
// 	'as' => 'users.index',
// 	'uses' => 'UserController@index'
// ]);
//
// Route::get('users', function () {
//     return App\User::paginate(4);
// });

// Route::get('/api?page=1', 'PostsController@apiPaginate');
// Route::get('/users', 'HomeController@getUsers')->name('users');

Route::get('/home', 'TweetController@index')->name('home')->middleware('auth');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/logout', 'LogoutController@logout');

Route::get('tweets', 'TweetController@show');
Route::post('/tweet', 'TweetController@saveTweet')->name('save-tweet');
Route::delete('/delete-tweet', 'TweetController@deleteTweet')->name('delete-tweet');
Route::post('/like-tweet', 'TweetController@likeTweet');
Route::post('/unlike-tweet', 'TweetController@unlikeTweet');
Route::get('/edit-tweet/{id}', 'TweetController@editTweetDisplay');
Route::post('/edit-tweet', 'TweetController@editTweet');

Route::post('/comment', 'CommentController@saveComment')->name('savecomment');
Route::delete('/delete/{id}', 'CommentController@deleteComment')->name('delete-comment');

Route::get('/edit-comment/{id}', 'CommentController@editCommentDisplay');
Route::post('/edit-comment', 'CommentController@editComment');
Route::post('tweets', 'UserController@upload');
// Route::get('/dashboard', 'HomeController@index')->name('home');
  // require __DIR__ . '/profile/profile.php';
// Route::get('profile', 'UserController@profile');
// Route::post('profile', 'UserController@update_avatar');
//
// Route::get('/edit-profile/{id}', 'UserController@editProfileDisplay');
// Route::post('/edit-profile', 'UserController@editProfile');

// Route::get('/redirect', 'SocialAuthFacebookController@redirect');
// Route::get('/callback', 'SocialAuthFacebookController@callback');



// Route::get('/user-display/{id}', 'UsersController@show')->name('user.show');
// Route::get('users/{user}', 'UsersController@show')->name('user.show');
// Route::get('users/{user}/follow', 'UsersController@follow')->name('user.follow');
// Route::get('users/{user}/unfollow', 'UsersController@unfollow')->name('user.unfollow');
// Route::post('/follow/{id}', 'UsersController@follow');
// Route::get('/unFollow', 'UsersController@unFollow');
// route::post('profile/{profileId}/follow', 'ProfileController@followUser')->name('user.follow');
// route::post('/{profileId}/unfollow', 'ProfileController@unFollowUser')->name('user.unfollow');
// Route::get('/user', 'ProfileController@show')->name('user');
// Route::post('profile/{profileId}/user-follow', 'UsersController@followUser')->name('user-follow');
// Route::post('/{profileId}/user-unfollow', 'UsersController@unFollowUser')->name('user-unfollow');
// Route::get('/post/{id}', 'PostsController@show')->name('posts.show');
// Route::get('Posts/{post}', 'PostController@show')->name('post.show');
// Route::get('/profile', 'UsersController@Profiledisplay');
// Route::post('profile/{profileId}/user-follow', 'UsersController@followUser')->name('user-follow');
// Route::post('/{profileId}/user-unfollow', 'UsersController@unFollowUser')->name('user-unfollow');
  // Route::get('/home', 'HomeController@index')->name('home');


  //Route::get('user', 'UsersController@index');
  //Route::get('user', 'UsersController@userFollowers');
  //Route::get('user/{user}/{name}', 'UsersController@userFollowers');


  // Route::get('profile', 'TweetController@profile');
  // Route::get('tweets', 'TweetController@tweets');
  // Route::get('tweets', 'TweetController@show');
  // Route::get('tweets', 'TweetController@show2');
  // Route::get('edit-tweet{id}', 'TweetController@editTweetDisplay');
  // Route::post('edit-tweet', 'TweetController@editTweet');

  // Route::post('profile', 'TweetController@editprofile');
  // Route::get('/home', 'TweetController@index');
  // Route::post('tweets', 'TweetController@create');
  // Route::post('tweets', 'TweetController@create_comment');
  // Route::get('home/{id}', 'TweetController@show');
  // Route::post('delete', 'TweetController@destroy');
  // Route::post('follow', 'TweetController@follow');
  // Route::post('/like-tweet', 'TweetController@likeTweet');
  // Route::get('locale/{locale}', function($locale){
  //     Session::put('locale',$locale);
  //     return redirect()->back();
  // });
