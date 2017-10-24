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
Route::group(['namespace' => 'Api'], function () {
    /*Route::post('/question/follower','QuestionFollowController@followThisQuestion')->middleware('auth:api');//用户关注一个问题
    Route::get('/topics','TopicsController@index')->middleware('api');//问题话题api
    Route::post('/topics','TopicsController@store')->middleware('api');//问题话题api
    Route::post('/question/isFollow','QuestionFollowController@isFollow')->middleware('auth:api');//用户是否关注了一个问题
    Route::post('/question/isLike','QuestionLikeController@isLike')->middleware('auth:api');//用户是否收藏了一个问题
    Route::post('/question/like','QuestionLikeController@likeThisQuestion')->middleware('auth:api');//用户收藏一个问题
    Route::get('user/followers/{id}','FollowersController@index');
    Route::post('user/follow','FollowersController@follow');
    Route::post('/answer/{id}/votes/users','VotesController@isVoted');//用户是否虽一个答案进行点赞
    Route::post('/answer/vote','VotesController@vote');//用户点赞一个答案
    Route::post('/message/store','MessagesController@store');//用户发送私信
//回答或者问题的评论
    Route::get('/answer/{id}/comments','CommentsController@answer');
    Route::get('/question/{id}/comments','CommentsController@question');
    Route::post('/comment','CommentsController@store');//用户评论*/


    Route::get('/topics','TopicsController@index')->middleware('auth:api');//问题话题api
    Route::post('/topics','TopicsController@store')->middleware('auth:api');//问题话题api

    Route::post('/question/isFollow','QuestionFollowController@isFollow')->middleware('api');//用户是否关注了一个问题
    Route::post('/question/follow','QuestionFollowController@followThisQuestion')->middleware('auth:api');//用户关注一个问题

    Route::get('user/followers/{id}','FollowersController@index');//用户被关注数
    Route::post('user/follow','FollowersController@follow');//用户是否被关注

    Route::post('/answer/{id}/votes/users','VotesController@isVoted');//用户是否对一个答案进行点赞
    Route::post('/answer/vote','VotesController@vote');//用户点赞一个答案

    Route::post('/message/store','MessagesController@store');//用户发送私信



    Route::post('/question/isLike','QuestionLikeController@isLike')->middleware('auth:api');//用户是否收藏了一个问题
    Route::post('/question/like','QuestionLikeController@likeThisQuestion')->middleware('auth:api');//用户收藏一个问题



//回答或者问题的评论
    Route::get('/answer/{id}/comments','CommentsController@answer');
    Route::get('/question/{id}/comments','CommentsController@question');
    Route::post('/comment','CommentsController@store');//用户评论
});
