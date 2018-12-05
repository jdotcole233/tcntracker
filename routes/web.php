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
    return view('auth.signin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/signin', 'PagesController@signin');

Route::get('/signup', 'PagesController@signup');

Route::get('/dashboard', 'PagesController@index');

Route::get('/farmer-profile', 'PagesController@farmerProfile');

Route::get('/buyer-profile', 'PagesController@buyerProfile');

Route::get('/create-buyer', 'PagesController@createBuyer');

Route::get('/edit-buyer', 'PagesController@editBuyer');

Route::get('/farmers', 'PagesController@farmers');

Route::get('/create-farmer', 'PagesController@createFarmer');

Route::get('/view-farmer', 'PagesController@viewFarmer');

Route::get('/edit-farmer', 'PagesController@editFarmer');

Route::get('/create-sale', 'PagesController@createSale');

Route::get('/edit-sale', 'PagesController@editSale');

Route::get('/farmer-sales', 'PagesController@farmerSales');

Route::get('/communities', 'PagesController@communities');

Route::get('/view-community', 'PagesController@viewCommunity');

Route::get('/create-community', 'PagesController@createCommunity');

Route::get('/edit-community', 'PagesController@editCommunity');

Route::get('/update-price', 'PagesController@updatePrice');
