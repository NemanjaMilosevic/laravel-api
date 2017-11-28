<?php

use Illuminate\Http\Request;
use App\Ad;

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

Route::post('logout', 'Auth\LoginController@logout');
Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');






Route::group(['middleware' => 'auth:api'], function() {


Route::get('ads', 'AdController@index');
Route::get('ads/{ad}', 'AdController@show');
Route::post('ads', 'AdController@store');
Route::put('ads/{ad}', 'AdController@update');
Route::delete('ads/{ad}', 'AdController@delete');
Route::put('ads/{ad}/rate', 'AdController@rate');
Route::put('ads/{ad}/extend', 'AdController@extend');


Route::delete('account', 'UserController@delete');
Route::get('users/all', 'UserController@index');
Route::get('users/{user}', 'UserController@show');

});
