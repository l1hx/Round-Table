<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

# 默认路由
Route::get('/', 'AccountsController@login');

# AccountsController的路由表
Route::get('/accounts/login', 'AccountsController@login');
Route::post('/accounts/loginAction', 'AccountsController@loginAction');
Route::get('/accounts/resetPassword', 'AccountsController@resetPassword');
Route::post('/accounts/confirmConfidentialAction', 'AccountsController@confirmConfidentialAction');
Route::post('/accounts/resetPasswordAction', 'AccountsController@resetPasswordAction');

#HomeController的路由表
Route::get('/home', 'HomeController@index');
Route::get('/home/getPageContentAction', 'HomeController@getPageContentAction');
Route::post('/home/editProfileAction', 'HomeController@editProfileAction');
Route::post('/home/editPasswordAction', 'HomeController@editPasswordAction');
Route::post('/home/editContactAction', 'HomeController@editContactAction');
Route::get('/home/getActivityAction', 'HomeController@getActivityAction');
Route::get('/home/attendActivityAction', 'HomeController@attendActivityAction');
