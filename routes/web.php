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
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/loker', 'HomeController@loker')->name('loker');
Route::get('/loker/filter', 'HomeController@filter')->name('filter');
Route::get('/loker/detail/{id}', 'HomeController@detail')->name('lokerDetail');
Route::get('/perusahaan', 'HomeController@company')->name('perusahaan');


Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'name' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/','AdminController@index')->name('admin');
    Route::get('/profile','ProfileController@index')->name('A-profile');
    Route::resource('test', 'TestController');
    Route::resource('jobs', 'JobController');
    Route::resource('users', 'UserController');
    Route::resource('companies', 'CompanyController');
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

    Route::get('/apply/pending', 'ApplicationController@pending')->name('U-pending');
    Route::get('/apply/ditolak', 'ApplicationController@ditolak')->name('U-ditolak');
    Route::get('/apply/diterima', 'ApplicationController@diterima')->name('U-diterima');
    Route::get('/apply/detail-loker/{id}', 'ApplicationController@detail')->name('U-DetailLoker');

    Route::get('/notifikasi', 'ApplicationController@notifikasi')->name('U-notifikasi');

});

Route::group(['prefix' => 'company', 'middleware' => 'company', 'name' => 'company', 'namespace' => 'Company'], function () {
    Route::get('/profile','ProfileController@index')->name('C-profile');
    Route::get('/','CompanyController@index')->name('company');
    
    Route::put('/profile/infoCompany/pic/update/{id}', 'ProfileController@updateProfile');
    Route::put('/profile/infoCompany/update/{id}', 'ProfileController@update');
    
    Route::get('/jobs', 'JobController@index')->name('C-jobs');
    Route::post('/jobs/store', 'JobController@store')->name('JobStore');
    Route::put('/jobs/update/{id}', 'JobController@update')->name('JobUpdate');
    Route::delete('/jobs/destroy/{id}', 'JobController@destroy')->name('JobDestroy');
    Route::get('/jobs/{id}', 'JobController@show')->name('JobDetail');
    
    Route::get('/pelamar', 'PelamarController@index')->name('C-pelamar');
    Route::get('/pelamar/apply/{id}', 'PelamarController@show')->name('C-DetailPelamar');
    Route::post('/pelamar/{id_app}', 'PelamarController@update')->name('C-Status');

    Route::get('/notifikasi', 'PelamarController@notifikasi')->name('C-notifikasi');

});

