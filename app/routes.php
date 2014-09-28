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

# AccountsController的路由表
Route::get('/', 'AccountsController@login');
Route::get('/accounts/login', 'AccountsController@login');
Route::post('/accounts/loginAction', 'AccountsController@loginAction');
