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
//
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'FrontController@index');
Route::get('event', 'FrontController@event');
Route::get('about', 'FrontController@about');
Route::post('/cities/list','FrontController@cityList')->name('cities.list');
Route::get('signup', 'FrontController@register');
Route::get('login', 'FrontController@login');
Route::post('signup', 'FrontController@SignUp');
Route::get('get-user-form', 'FrontController@getUserFrom');
Route::post('add-more-child', 'FrontController@addMoreChild');

Route::get('admin/login', 'Admin\LoginController@login');
Route::post('admin/authenticate','Admin\LoginController@validateLogin')->name('admin.login');
Route::get('admin/logout','Admin\LoginController@logout')->name('admin.logout');

Route::group(['namespace' => 'Admin','prefix' => 'admin', 'middleware' => ['adminAuth']] ,function(){
	Route::get('dashboard', 'LoginController@dashboard');

	//state	
	Route::get('states/table/','StateController@datatableView')->name('states.table');
	Route::post('states/drop-down','StateController@getStateAsDropDownOptions')->name('states.drop-down');
	Route::patch('states/changestatus/{users}','StateController@changeStatus')->name('states.changestatus');
	Route::resource('states','StateController');
});