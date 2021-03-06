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

Route::get('notification-history', 'API\UserController@notification_history');
Route::post('get-user-info', 'API\UserController@getUserInfo');
Route::get('faq', 'API\UserController@faq');
Route::post('feedback', 'API\UserController@feedback');
Route::post('delete-user', 'API\UserController@deleteUser');
Route::get('service-category-list', 'API\ServiceController@ServiceCategoryList');
Route::post('service-sub-category-list', 'API\ServiceController@ServiceSubCategoryList');
Route::post('provider-service-list', 'API\ServiceController@ServiceListForProvider');
Route::post('user-signup', 'API\UserController@SignUp2');
Route::post('provider-signup', 'API\UserController@SignUp2');
Route::post('bank-details', 'API\UserController@addBankDetail');
Route::post('add-qualification', 'API\UserController@addQualification');
Route::post('update-documents', 'API\UserController@addDocuments');
Route::post('update-address', 'API\UserController@updateAddress');

Route::post('login', 'API\UserController@login');
Route::post('verify_email_phone', 'API\UserController@verifyEmailPhone');
Route::post('register', 'API\UserController@register');
Route::post('forgot_password', 'API\UserController@forgotPassword');
Route::post('otp', 'API\UserController@otp');
Route::post('verify-otp', 'API\UserController@verifyOtp');
Route::post('change-password', 'API\UserController@ChangePassword');

Route::post('reset-password', 'API\UserController@ResetPassword');
Route::post('add-service-category', 'API\ServiceController@addServiceCategory');
Route::post('edit-service-category', 'API\ServiceController@editServiceCategory');

Route::post('add-service-subcategory', 'API\ServiceController@addServiceSubCategory');
Route::post('edit-service-subcategory', 'API\ServiceController@editServiceSubCategory');

Route::post('add-service', 'API\ServiceController@addService');
Route::post('edit-service', 'API\ServiceController@editService');
Route::post('delete-service', 'API\ServiceController@deleteService');


Route::post('add-service-days', 'API\ServiceController@addServiceDays');
Route::post('edit-service-days', 'API\ServiceController@editServiceDays');

Route::post('country', 'API\UserController@country');
Route::post('city', 'API\UserController@city');
Route::post('state', 'API\UserController@state');
Route::post('profile', 'API\UserController@profile');
Route::post('profile-update', 'API\UserController@updateProfile');

Route::post('provider-booking-list', 'API\UserController@providerBookingList');
Route::post('provider-subscription-list', 'API\UserController@providerSubscriptionList');
Route::post('provider-subscribe', 'API\UserController@providerSubscribe');

Route::post('update-location', 'API\UserController@updateLocation');


Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');
});