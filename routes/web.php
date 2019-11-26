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
Route::get('/flower-details/{id}', 'FlowerController@details');

// MANAGE FLOWERS page
Route::group(['prefix' => '/manage-flowers'], function() {
    Route::get('/', 'FlowerController@index');
    Route::get('/insert', 'FlowerController@showInsert');
    Route::post('/insert', 'FlowerController@insert');
    Route::get('/update/{id}', 'FlowerController@showUpdate');
    Route::post('/update/{id}', 'FlowerController@update');
    Route::get('/delete/{id}', 'FlowerController@delete');
});

// MANAGE FLOWER TYPES page
Route::group(['prefix' => '/manage-flower-types'], function() {
    Route::get('/', 'FlowerTypeController@index');
    Route::get('/insert', 'FlowerTypeController@showInsert');
    Route::post('/insert', 'FlowerTypeController@insert');
    Route::get('/update/{id}', 'FlowerTypeController@showUpdate');
    Route::post('/update/{id}', 'FlowerTypeController@update');
    Route::get('/delete/{id}', 'FlowerTypeController@delete');
});

// MANAGE COURIERS page
Route::group(['prefix' => '/manage-couriers'], function() {
    Route::get('/', 'CourierController@index');
    Route::get('/insert', 'CourierController@showInsert');
    Route::post('/insert', 'CourierController@insert');
    Route::get('/update/{id}', 'CourierController@showUpdate');
    Route::post('/update/{id}', 'CourierController@update');
    Route::get('/delete/{id}', 'CourierController@delete');
});

// PROFILE page
Route::group(['prefix' => '/profile'], function() {
    Route::get('/', 'UserController@profile');
    Route::post('/update/{id}', 'UserController@updateProfile');
});

// MANAGE USERS page
Route::group(['prefix' => '/manage-users'], function() {
    Route::get('/', 'UserController@index');
});