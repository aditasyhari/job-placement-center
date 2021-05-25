<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'name' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/','AdminController@index')->name('admin');
    Route::get('/profile','ProfileController@index')->name('A-profile');
    Route::resource('test', 'TestController');
});

Route::group(['prefix' => 'user', 'middleware' => 'user', 'name' => 'user', 'namespace' => 'User'], function () {
    Route::get('/','UserController@index')->name('user');
    Route::get('/profile','ProfileController@index')->name('U-profile');

    Route::post('/profile/skill/store','SkillController@store')->name('SkillStore');
    Route::delete('/profile/skill/destroy/{id}','SkillController@destroy')->name('SkillDestroy');

    Route::post('/profile/pendidikan/store', 'PendidikanController@store')->name('PendidikanStore');
    Route::delete('/profile/pendidikan/destroy/{id}', 'PendidikanController@destroy')->name('PendidikanDestroy');

    Route::post('/profile/licensi/store', 'LicensiController@store')->name('LicensiStore');
    Route::delete('/profile/licensi/destroy/{id}', 'LicensiController@destroy')->name('LicensiDestroy');

    Route::put('/profile/infoUser/pic/update/{id}', 'ProfileController@updateProfile');
    Route::put('/profile/infoUser/update/{id}', 'ProfileController@update');
    
    Route::post('/apply', 'ApplicationController@store')->name('ApplyStore');

});

Route::group(['prefix' => 'company', 'middleware' => 'company', 'name' => 'company', 'namespace' => 'Company'], function () {
    Route::get('/profile','ProfileController@index')->name('C-profile');
    Route::get('/','CompanyController@index')->name('company');
    
    Route::put('/profile/infoCompany/pic/update/{id}', 'ProfileController@updateProfile');
    Route::put('/profile/infoCompany/update/{id}', 'ProfileController@update');
    
    Route::get('/jobs', 'JobController@index')->name('C-jobs');
    Route::post('/jobs/store', 'JobController@store')->name('JobStore');
    Route::delete('/jobs/destroy/{id}', 'JobController@destroy')->name('JobDestroy');
    Route::get('/jobs/{id}', 'JobController@show')->name('JobDetail');
    
    Route::get('/pelamar', 'PelamarController@index')->name('C-pelamar');

});

