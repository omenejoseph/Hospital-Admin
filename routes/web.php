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

Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');


Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/bill/{id}', 'AdminPatientsController@payBill');
// Route::get('/bill/', function(){
//     return view('bill.index');
// });


Route::group( [ 'middleware' => 'auth'], function()
{
    // Route::post('/admin/staff/update/{id}', ['as' => 'admin.stpaff.update', 'uses' => 'AdminStaffController@update']);
Route::resource('/admin/staff', 'AdminStaffController');
// Route::get('/admin/staff', 'AdminStaffController@index');
Route::post('/admin/staff/update/', 'AdminStaffController@update')->name('admin.staff.update');
Route::delete('/admin/staff/delete/', 'AdminStaffController@destroy')->name('admin.staff.delete');

Route::resource('/admin/ward', 'AdminWardController');
Route::delete('/admin/ward/{id}/delete/', 'AdminWardController@destroy')->name('admin.ward.delete');

Route::resource('/admin/beds', 'AdminBedsController');
Route::delete('/admin/beds/{id}/delete/', 'AdminBedsController@destroy')->name('admin.beds.delete');
Route::get('/admin/beds/{id}/', 'AdminBedsController@show')->name('admin.beds.show');


Route::get('/admin/patients/{id}/bill', 'AdminPatientsController@bill')->name('admin.patients.bill');
Route::get('/admin/patients/calcBill', 'AdminPatientsController@calcBill')->name('admin.patients.calcBill');
Route::get('/admin/patients/patientBill')->name('admin.patients.patientBill');
Route::get('/admin/patients/patientBill', 'AdminPatientsController@emailBill')->name('admin.patients.emailBill');
Route::resource('/admin/patients', 'AdminPatientsController');
Route::get('/admin/patients/{id}', 'AdminPatientsController@show')->name('admin.patients.show');
Route::get('/admin/patients/update/', 'AdminPatientsController@update')->name('admin.patients.update');

    Route::get('/admin/messages/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('/admin/messages/create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/admin/messages/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('/admin/messages/{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('/admin/messages/{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
