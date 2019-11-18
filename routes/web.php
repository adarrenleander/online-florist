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
Route::get('/flower-details/{id}', 'FlowerDetailsController@index');

// MANAGE FLOWERS page
Route::get('/manage-flowers', 'ManageFlowersController@index');
Route::post('/manage-flowers', 'ManageFlowersController@search');
Route::group(['prefix' => '/manage-flowers'], function() {
    Route::get('/insert', 'ManageFlowersController@showInsert');
    Route::post('/insert', 'ManageFlowersController@insert');
    Route::get('/update/{id}', 'ManageFlowersController@showUpdate');
    Route::post('/update/{id}', 'ManageFlowersController@update');
    Route::get('/delete/{id}', 'ManageFlowersController@delete');
});