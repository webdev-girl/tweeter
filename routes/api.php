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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/users', "TweetsController@getAllUsers");
Route::get('/tweet', 'TweetsController@getAllTweets');
Route::get('/comment', 'TweetsController@getAllComments');
Route::get('/tweet-comments/{tweetId}', 'TweetsController@getTweetComments');
Route::post('/new-comment', 'TweetsController@newCommentViaApi');
Route::get('/new-comment', 'TweetsController@newCommentViaApi');
Route::post('/tweet-like/{tweetId}', 'TweetsController@likeTweetViaApi');
Route::post('/tweet-like/{tweetId}', 'TweetsController@getAllTweetLikesApi');
Route::post('/tweet-delete', 'TweetsController@deleteTweetViaApi');
Route::post('/comment-delete', 'TweetsController@deleteCommentViaApi');
Route::get('/users-follow', 'TweetsController@followUserViaApi');
Route::get('/tweetsbynumber/{number}', 'TweetsController@getAllTweetsByNumber');
Route::get('/tweetsbynumberfromstartpoint/{number}/{id}', 'TweetsController@getAllTweetsByNumberFromStartPoint');
