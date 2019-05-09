<?php

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

Route::post('yue/index','YueController@index');
Route::any('yue/show','YueController@show');
Route::any('yue/delete/{id}','YueController@delete');

Route::any('yue/update/{id}','YueController@update');
Route::any('yue/add_order','YueController@add_order');

