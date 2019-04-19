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
Route::get('get-states/{id}', 'FrontController@statesListing');
Route::get('about', 'FrontController@about');
Route::get('/cities/list','FrontController@getCities')->name('cities.list');
Route::get('/states/list','FrontController@getStates')->name('states.list');
/*Route::post('/cities/list','FrontController@cityList')->name('cities.list');
Route::post('/states/list','FrontController@stateList')->name('states.list');*/
Route::get('signup', 'FrontController@register');
Route::get('login', 'FrontController@login');
Route::post('login', 'FrontController@auth');
Route::get('forgot-password', 'FrontController@forgotPassword');
Route::post('forgot', 'FrontController@sendForgotOTp');
Route::get('change-password', 'FrontController@newPassword');
Route::post('change-password', 'FrontController@changePassword');
Route::post('signup', 'FrontController@SignUp');
Route::get('get-user-form', 'FrontController@getUserFrom');
Route::post('add-more-child', 'FrontController@addMoreChild');
Route::get('logout', 'FrontController@logout');
Route::get('contact', 'FrontController@contact');
Route::get('verify-otp/{id}', 'FrontController@sendOtp');
Route::post('verify-otp/{id}', 'FrontController@verifyOtp');
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

/*ROUTE FOR USER*/
Route::group(['prefix' => 'user', 'middleware' => ['userAuth']] ,function(){
	Route::get('profile', 'UserProfileController@profile');
	Route::get('dashboard', 'FrontController@userDashboard');
});

/*ROUTE FOR USER*/
Route::group(['prefix' => 'provider', 'middleware' => ['providerAuth']] ,function(){
	Route::get('dashboard', 'FrontController@providerDashboard');
	Route::get('profile', 'UserProfileController@profile');
	Route::post('update-profile', 'UserProfileController@updateProfile');
	
	Route::get('service', 'FrontController@service');
	Route::get('service/{id}', 'FrontController@serviceDetails');
	Route::post('update-service', 'FrontController@updateService');
	Route::post('change-password', 'UserProfileController@changePassword');

	Route::get('my-bookings','FrontController@myBookings');

});

/*ROUTE FOR ADMIN*/
Route::get('admin/login', 'Admin\LoginController@login');
Route::post('admin/authenticate','Admin\LoginController@validateLogin')->name('admin.login');
Route::get('admin/logout','Admin\LoginController@logout')->name('admin.logout');

//Admin Forget Password
Route::resource('admin/forget','Admin\ForgetPasswordController');
Route::get('admin/setpassword','Admin\ForgetPasswordController@setpassword');
Route::post('admin/updatepassword/{id}','Admin\ForgetPasswordController@updatepassword');


Route::group(['namespace' => 'Admin','prefix' => 'admin', 'middleware' => ['adminAuth']] ,function(){
	Route::get('dashboard', 'LoginController@dashboard')->name('dashboard');

	//state	
	Route::get('states/table/','StateController@datatableView')->name('states.table');
	Route::post('states/drop-down','StateController@getStateAsDropDownOptions')->name('states.drop-down');
	Route::patch('states/changestatus/{users}','StateController@changeStatus')->name('states.changestatus');
	Route::resource('states','StateController');

	//state	
	Route::get('city/table/','CityController@datatableView')->name('city.table');
	Route::post('city/drop-down','CityController@getCityAsDropDownOptions')->name('city.drop-down');
	Route::patch('city/changestatus/{users}','CityController@changeStatus')->name('city.changestatus');
	Route::resource('city','CityController');

	//Provider Controller
	Route::get('provider/edit-bank/{id}','ProviderController@editbank');
	Route::post('provider/edit-bank/{id}','ProviderController@updateBank');

	Route::get('provider/edit-qualification/{id}','ProviderController@editqualification');
	Route::post('provider/edit-qualification/{id}','ProviderController@updatequalification');

	Route::get('provider/edit-document/{id}','ProviderController@editDocument');
	Route::post('provider/edit-document/{id}','ProviderController@updateDocument');

	Route::post('provider/updatestatus','ProviderController@updatestatus');
	Route::resource('provider','ProviderController');

	//Provider Controller
	Route::get('user/view-children/{id}','UserController@viewChildren');
	Route::resource('user','UserController');


	//Category Controller
	Route::post('category/deleterecord','CategoryController@deleterecord');
	Route::post('category/status','CategoryController@updatestatus');
	Route::resource('category','CategoryController');

	//SubCategory Controller
	Route::post('subcategory/deleterecord','SubCategoryController@deleterecord');
	Route::post('subcategory/status','SubCategoryController@updatestatus');
	Route::resource('subcategory','SubCategoryController');

	//Sub-Admin Controller
	Route::post('subadmin/status','SubAdminController@updatestatus');
	Route::post('subadmin/password','SubAdminController@passwordreset')->name('subadmin.passwordreset');
	Route::resource('subadmin','SubAdminController',array(
		'names'=>array(
				'index' =>'subadmin.index',
				'create'=>'subadmin.create',
				'store' =>'subadmin.store',
				'edit'  =>'subadmin.edit',
				'update'=>'subadmin.update',

		)
	));

	//Subscription
	Route::resource('subscription','SubscriptionController');
	Route::post('subscription/status','SubscriptionController@updatestatus');


	/////Locations
	Route::get('provider-locations','ProviderController@locations');
	Route::get('provider-location','ProviderController@viewLocation');
	

});