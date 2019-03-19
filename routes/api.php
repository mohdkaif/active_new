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
/*Route::get('/kaif', 'ApiController@login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::post('signup', 'API\UserController@signup');
Route::post('login', 'API\UserController@login');
Route::post('verify_email_phone', 'API\UserController@verifyEmailPhone');
Route::post('register', 'API\UserController@register');
Route::post('forgot_password', 'API\UserController@forgotPassword');
Route::post('otp', 'API\UserController@otp');
Route::post('change-password', 'API\UserController@ChangePassword');

Route::post('country', 'API\UserController@country');
Route::post('city', 'API\UserController@city');
Route::post('state', 'API\UserController@state');

Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');
});