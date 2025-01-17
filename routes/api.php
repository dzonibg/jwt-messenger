<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/', 'AuthController@index');
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/user', 'AuthController@user')->middleware('auth:api');
Route::post('/logout', 'AuthController@logout')->middleware('auth:api');

Route::resource('message', 'MessageController');
Route::post('/message/send', 'MessageController@sendMessage');
Route::post('/message/last', 'MessageController@lastMessage');
Route::post('/message/unread', 'MessageController@unreadMessages');
Route::post('/message/check', 'MessageController@checkMessages');
Route::post('/message/get', 'MessageController@getMessage');
