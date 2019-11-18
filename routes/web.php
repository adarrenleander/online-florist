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

Auth::routes();

// HOME (CATALOG) page
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@search');

// FLOWER DETAILS page
Route::get('/flower-details/{id}', 'FlowerController@detail');

// MANAGE FLOWERS page
Route::get('/manage-flowers', 'FlowerController@index');
Route::post('/manage-flowers', 'FlowerController@search');

Route::group(['prefix' => '/manage-flowers'], function() {
    Route::get('/insert', 'FlowerController@showInsert');
    Route::post('/insert', 'FlowerController@insert');
    Route::get('/update/{id}', 'FlowerController@showUpdate');
    Route::post('/update/{id}', 'FlowerController@update');
    Route::get('/delete/{id}', 'FlowerController@delete');
});