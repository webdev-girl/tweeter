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
//
// Route::get('/users/index', function () {
//         return view('users/index');
// });

Route::get('/profile', function () {
        return view('profile');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('posts', 'PostsController');
    
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('users', 'UsersController@index')->name('users');
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
    Route::get('/notifications', 'UsersController@notifications');
});
// Route::get('tweets', 'TweetsController@index')->name('tweets.index');
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


Route::get('/home', 'TweetsController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/logout', 'LogoutController@logout');
Route::get('tweet', 'TweetsController@show');
Route::post('/tweet', 'TweetsController@saveTweet')->name('save-tweet');
Route::delete('/delete-tweet', 'TweetsController@deleteTweet')->name('delete-tweet');
Route::post('/like-tweet', 'TweetsController@likeTweet');
Route::get('/edit-tweet/{id}', 'TweetsController@editTweetDisplay');
Route::post('/edit-tweet', 'TweetsController@editTweet');
Route::post('/comment', 'TweetsController@saveComment')->name('save-comment');
Route::get('/comment', 'TweetsController@index');
Route::delete('/delete/{id}', 'CommentsController@deleteComment')->name('delete-comment');
Route::get('/edit-comment/{id}', 'TweetsController@editCommentDisplay');
Route::post('/edit-comment', 'TweetsController@editComment');
Route::post('tweets', 'UsersController@upload');
Route::get('/dashboard', 'HomeController@index')->name('home');
// require __DIR__ . '/profile/profile.php';

// Route::get('profile', 'UsersController@profile');
// Route::post('profile', 'UsersController@update_avatar');

Route::get('/edit-profile/{id}', 'UsersController@editProfileDisplay');
Route::post('/edit-profile', 'UsersController@editProfile');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');


Route::get('/posts', 'PostsController@index')->name('posts.index');
Route::post('/posts', 'PostsController@store');
Route::get('/posts', 'PostsController@create');
Route::get('/posts{id}', 'PostsController@show')->name('posts.show');
Route::get('posts/{post}', 'PostsController@show')->name('post.show');

Route::post('follow', 'TweetsController@followUser');

Route::get('users/{user}', 'UsersController@show')->name('user.show');
Route::get('users/{user}/follow', 'TweetsController@follow')->name('user.follow');
Route::get('users/{user}/unfollow', 'TweetsController@unfollow')->name('user.unfollow');
Route::get('users/{user}/follow', 'UsersController@follow')->name('user.follow');
Route::post('users/{user}/unfollow', 'UsersController@unfollow')->name('user.unfollow');

Route::get('lang/{locale}', 'HomeController@lang');
Route::get('locale/{locale}', function($locale){
    Session::put('locale',$locale);
    return redirect()->back();
});
Route::get('/profiles', function(){
    return redirect('/profiles/' . Auth::id() );
});
Route::get('/user-display/{id}', 'UsersController@show')->name('user.show');
Route::get('users/{user}', 'UsersController@show')->name('user.show');

Route::post('/follow/{id}', 'UsersController@follow');
Route::get('/unFollow', 'UsersController@unFollow');
route::post('profile/{profileId}/follow', 'ProfileController@followUser')->name('user.follow');
route::post('/{profileId}/unfollow', 'ProfileController@unFollowUser')->name('user.unfollow');
Route::get('/user', 'ProfileController@show')->name('user');
Route::post('profile/{profileId}/user-follow', 'UsersController@followUser')->name('user-follow');
Route::post('/{profileId}/user-unfollow', 'UsersController@unFollowUser')->name('user-unfollow');
Route::post('profile/{profileId}/user-follow', 'UsersController@followUser')->name('user-follow');
Route::post('/{profileId}/user-unfollow', 'UsersController@unFollowUser')->name('user-unfollow');
Route::get('users', 'UsersController@index');
Route::get('user', 'UsersController@userFollowers');
Route::get('user/{user}/{name}', 'UsersController@userFollowers');
Route::get('tweets', 'TweetsController@show1');
Route::get('tweets', 'TweetsController@show2');
Route::post('profile', 'TweetsController@editprofile');
Route::get('home/{id}', 'TweetsController@show');
