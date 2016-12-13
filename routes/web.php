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

    Route::get('/company/{company}/settings/edit', 'Admin\Company\SettingController@edit');
    Route::post('/company/{company}/settings/store', 'Admin\Company\SettingController@store');
    Route::match(['put', 'patch'],'/company/{company}/settings/update', 'Admin\Company\SettingController@update')
        ->name('company.settings.update');

    Route::resource('provider', 'Admin\ProviderController');
    Route::resource('client', 'Admin\ClientController');
    Route::get('/client/{client}/settings/edit', 'Admin\Client\SettingController@edit');
    Route::post('/client/{client}/settings/store', 'Admin\Client\SettingController@store');
    Route::match(['put', 'patch'],'/client/{client}/settings/update', 'Admin\Client\SettingController@update')
        ->name('client.settings.update');
    Route::resource('fax', 'Admin\FaxController');
    Route::delete('/fax/{fax_id}/sender/{sender_id}/delete', 'Admin\Fax\SenderController@destroy');
    Route::delete('/fax/{fax_id}/recipient/{recipient_id}/delete', 'Admin\Fax\RecipientController@destroy');
    Route::resource('user', 'Admin\UserController');
});

Auth::routes();

//Route::get('/api/users', 'API\UserController@index');


Route::get('/home', 'HomeController@index');