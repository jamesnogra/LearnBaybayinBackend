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

Route::post('/user/register', 'UserController@postRegister');
Route::post('/user/update-favorite-subjects', 'UserController@postUpdateFavoriteSubjects');
Route::post('/user/check-token', 'UserController@postCheckToken');
Route::post('/user/login', 'UserController@postLogin');

Route::post('/score/add-score', 'ScoreController@postAddScore');
Route::get('/score/get-score', 'ScoreController@getScore');
Route::post('/score/save-total-scores', 'ScoreController@postTotalScores');