<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});



Route::get('/', 'Home@index');

Route::get('/response', 'Home@search');

Route::post('register', 'Auth@register');

Route::post('login', 'Auth@login');

Route::post('logout', 'Auth@logout');