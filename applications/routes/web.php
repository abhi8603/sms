<?php

use Illuminate\Support\Facades\Route;

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
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('forgot-password',function(){
    return view('forgotPassword');
});
Auth::routes(); 
Route::post('/user/register', 'HomeController@UserRegister');
Route::post('/update-password', 'HomeController@UpdatePassword');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/application/select', 'ApplicationController@selectCourse');
Route::match(['get', 'post'],'/application', 'ApplicationController@index');
Route::match(['get', 'post'],'/application/parents/{id}', 'ApplicationController@parentsTab');
Route::match(['get', 'post'],'/application/address/{id}', 'ApplicationController@addressTab');
Route::match(['get', 'post'],'/application/qualification/{id}', 'ApplicationController@qualificationTab');
Route::match(['get', 'post'],'/application/document/{id}', 'ApplicationController@documentTab');
Route::post('/application/subject/{id}', 'ApplicationController@subjectTab');
Route::match(['get', 'post'],'/application/photo/{id}', 'ApplicationController@photoTab');
Route::match(['get', 'post'],'/application/undertaking/{id}', 'ApplicationController@undertakingTab');
Route::match(['get', 'post'],'/application/payment/{id}', 'ApplicationController@PaymentTab');
Route::get('/application/instructions', 'ApplicationController@instructions');


Route::post('/payonline/pay','ApplicationController@onlinepay');
Route::post('/payonline/paymentgatway/redirect','ApplicationController@payredirect');
Route::get('payonline/receipt/{id}','ApplicationController@viewreceipt');
Route::get('payonline/fail/{id}','ApplicationController@paymentfailure');
Route::match(['get', 'post'],'application/payonline/getresponse','ApplicationController@getpaymentgatwayresponse');


Route::post('/application/paymentRequest', 'ApplicationController@paymentRequest');
Route::match(['get', 'post'],'/application/paymentResponse', 'ApplicationController@paymentResponse');
Route::match(['get', 'post'],'/application/payment/response', 'ApplicationController@paymentResponse');
Route::get('/application/Download/{id}/{email}', 'ApplicationController@downloadForm');
Route::post('/application/save', 'ApplicationController@save');
Route::post('/application/save/upload', 'ApplicationController@fileUpload');
