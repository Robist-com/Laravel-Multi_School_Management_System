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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// // Route::resource('admission', 'ApiAdmissionController');

// // Route::get('student', 'ApiStudentController@getStudent')->name('student.index');
// // Route::get('admission', 'ApiAdmissionController@getAdmission')->name('admission.index');

// // Route::middleware('auth:api')->get('/user', function (Request $request) {

// //     return $request->user();

// //     // Route::resource('admission', 'ApiAdmissionController');
// //     Route::get('admission', 'ApiAdmissionController@getAdmission')->name('admission.index');
// //  });
 
// //  Route::post('login', 'API\PassportController@login');
 
// //  Route::post('register', 'API\PassportController@register');
 
//  Route::group(['middleware' => 'auth:api'], function(){
 
    // Route::get('admission', 'ApiAdmissionController@getAdmission')->name('admission.index');
 
//  });


 Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
 
 });

 Route::get('admission', 'ApiAdmissionController@getAdmission')->name('admission.index')->middleware('auth:api');;
 
 Route::post('login', 'API\AdmissionController@login');
 
 Route::post('register', 'API\AdmissionController@register');
 
 Route::group(['middleware' => 'auth:api'], function(){
 
 Route::post('get-details', 'API\AdmissionController@getDetails');

//  Route::get('admission', 'API\AdmissionController@getAdmission')->name('admission.index');

 
 });