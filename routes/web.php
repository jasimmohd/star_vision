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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index');

Route::prefix('admin')->group(function(){
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/','AdminController@index')->name('admin.dashboard');
});

Route::prefix('agent')->group(function(){
    Route::get('/login','Auth\AgentLoginController@showLoginForm')->name('agent.login');
    Route::post('/login','Auth\AgentLoginController@login')->name('agent.login.submit');
    Route::get('/','AgentController@index')->name('agent.dashboard');
});

Route::prefix('broadband')->group(function(){
    Route::get('/login','Auth\BroadbandLoginController@showLoginForm')->name('broadband.login');
    Route::post('/login','Auth\BroadbandLoginController@login')->name('broadband.login.submit');
    Route::get('/','BroadbandController@index')->name('broadband.dashboard');
});

Route::prefix('cabletv')->group(function(){
    Route::get('/login','Auth\CabletvLoginController@showLoginForm')->name('cabletv.login');
    Route::post('/login','Auth\CabletvLoginController@login')->name('cabletv.login.submit');
    Route::get('/','CabletvController@index')->name('cabletv.dashboard');
});