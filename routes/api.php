<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', "UserController@getAllUsers");
// Route::get('/tweets', 'TweetController@getSaveTweets');
Route::get('/tweets', 'TweetController@getAllTweets');

Route::get('/tweet-comments/{tweetId}', 'TweetController@getTweetComments');
Route::post('/new-comment', 'TweetController@newCommentViaApi');
Route::post('/tweet-likes', 'TweetController@likeTweetViaApi');
Route::post('/tweet-unLikes', 'TweetController@unLikeTweetViaApi');
Route::post('/tweet-delete', 'TweetController@deleteTweetViaApi');
Route::post('/follow-user', 'TweetController@followUserViaApi');
Route::get('/tweetsbynumber/{number}', 'TweetController@getAllTweetsByNumber');
Route::get('/tweetsbynumberfromstartpoint/{number}/{id}', 'TweetController@getAllTweetsByNumberFromStartPoint');
Route::get('/commentsbynumberfromstartpoint/{number}/{id}', 'TweetController@getAllCommentsByNumberFromStartPoint');
