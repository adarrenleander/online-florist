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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome');  // initial landing page

Auth::routes(); // defines all of the routes related to authorization

// the routes below can only be accessed once user has logged in
Route::group(['middleware' => 'checkGuest'], function() {
    // HOME (CATALOG) page
    Route::get('/home', 'HomeController@index')->name('home');  // show catalog page

    // FLOWER DETAILS page
    Route::get('/flower-details/{id}', 'FlowerController@details'); // show flower details page

    // PROFILE page
    Route::group(['prefix' => '/profile'], function() {
        Route::get('/', 'UserController@profile');  // show profile page
        Route::post('/update/{id}', 'UserController@updateProfile');    // update profile
    });

    // CART functionalities
    Route::group(['prefix' => '/cart'], function() {
        Route::get('/', 'TransactionController@cart');  // show cart page
        Route::get('/order/{flower_id}', 'TransactionController@order');    // for the "Order" button in Catalog
        Route::post('/add/{flower_id}', 'TransactionController@add');   // for the "Add to cart" button in Flower Details
        Route::get('/remove/{flower_id}', 'TransactionController@remove');  // remove flower from the cart
        Route::post('/checkout', 'TransactionController@checkout'); // for the "Checkout" button in Cart
    });

    // the routes below are only authorized for admins
    Route::group(['middleware' => 'checkAdmin'], function() {
        // MANAGE FLOWERS page
        Route::group(['prefix' => '/manage-flowers'], function() {
            Route::get('/', 'FlowerController@index');  // show manage flowers page
            Route::get('/insert', 'FlowerController@showInsert');   // show insert flower page
            Route::post('/insert', 'FlowerController@insert');  // insert new flower
            Route::get('/update/{id}', 'FlowerController@showUpdate');  // show update flower page
            Route::post('/update/{id}', 'FlowerController@update'); // update flower
            Route::get('/delete/{id}', 'FlowerController@delete');  // delete flower
        });

        // MANAGE FLOWER TYPES page
        Route::group(['prefix' => '/manage-flower-types'], function() {
            Route::get('/', 'FlowerTypeController@index');  // show manage flower types page
            Route::get('/insert', 'FlowerTypeController@showInsert');   // show insert flower type page
            Route::post('/insert', 'FlowerTypeController@insert');  // insert new flower type
            Route::get('/update/{id}', 'FlowerTypeController@showUpdate');  // show update flower type page
            Route::post('/update/{id}', 'FlowerTypeController@update'); // update flower type
            Route::get('/delete/{id}', 'FlowerTypeController@delete');  // delete flower type
        });

        // MANAGE COURIERS page
        Route::group(['prefix' => '/manage-couriers'], function() {
            Route::get('/', 'CourierController@index'); // show manage couriers page
            Route::get('/insert', 'CourierController@showInsert');  // show insert courier page 
            Route::post('/insert', 'CourierController@insert'); // insert new courier
            Route::get('/update/{id}', 'CourierController@showUpdate'); // show update courier page
            Route::post('/update/{id}', 'CourierController@update');    // update courier
            Route::get('/delete/{id}', 'CourierController@delete'); // delete courier
        });

        // MANAGE USERS page
        Route::group(['prefix' => '/manage-users'], function() {
            Route::get('/', 'UserController@index');    // show manage users page
            Route::get('/update/{id}', 'UserController@showUpdate');    // show update user page
            Route::post('/update/{id}', 'UserController@update');   // update user
            Route::get('/remove/{id}', 'UserController@remove');    // remove user
        });

        // TRANSACTION HISTORY
        Route::get('/transaction-history', 'TransactionController@history');    // show transaction history page
    });
});