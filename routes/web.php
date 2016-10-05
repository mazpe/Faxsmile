<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('test', 'TestController@index');
    Route::resource('company', 'Admin\CompanyController');
    Route::resource('provider', 'Admin\ProviderController');
    Route::resource('client', 'Admin\ClientController');
    Route::resource('fax', 'Admin\FaxController');
    Route::delete('/fax/{fax_id}/sender/{sender_id}/delete', 'Admin\Fax\SenderController@destroy');
    Route::resource('user', 'Admin\UserController');
});

Auth::routes();

//Route::get('/api/users', 'API\UserController@index');


Route::get('/home', 'HomeController@index');