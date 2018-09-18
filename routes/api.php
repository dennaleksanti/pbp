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

Route::get('register', 'RegisterController@index');
Route::get('register/{id}', 'RegisterController@get');
Route::post('register', 'RegisterController@store');
Route::patch('register/{id}', 'RegisterController@update');
Route::delete('register/{id}', 'RegisterController@destroy');

Route::get('role', 'RoleController@index');
Route::post('role', 'RoleController@store');
Route::patch('role/{id}', 'RoleController@update');
Route::delete('role/{id}', 'RoleController@destroy');
