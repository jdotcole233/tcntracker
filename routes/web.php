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


Route::get('/farmers', 'PagesController@farmers');

Route::get('/create-farmer', 'PagesController@createFarmer');

// Route::get('/view-farmer/{id}', 'PagesController@viewFarmer');


Route::get('/create-sale/{id}', 'PagesController@createSale');



Route::get('/communities', 'PagesController@communities');

Route::get('/create-community', 'PagesController@createCommunity');


Route::get('/update-price', 'PagesController@updatePrice');







// Community controller functions
Route::post('/register_community','communityController@register_community');
Route::get('/fetch_communities','communityController@list_out_communities');
Route::get('/view-community/{id}', 'communityController@list_community');
Route::get('/edit-community/{id}', 'communityController@editCommunity');
Route::post('/edit-forCommunity', 'communityController@update_community_details');



//Buyer controller functions
Route::post('/register_buyer','buyerController@register_buyer');
Route::get('/fetch_buyers','buyerController@list_out_buyers');
Route::get('/edit-buyer/{id}', 'buyerController@editBuyer');
Route::post('/edit-forBuyer', 'buyerController@editBuyerDetails');



//farmer controller functions
Route::post('/register_farmer','farmerController@register_farmer');
Route::get('/fetch_farmers','farmerController@list_out_farmers');
Route::post('/create-sale-forfarmer', 'farmerController@create_sale');
Route::get('/view-farmer/{id}', 'farmerController@viewFarmer');
Route::get('/edit-farmer/{id}', 'farmerController@editFarmer');
Route::post('/edit-forfarmer','farmerController@editFarmerDetails');

//farmer sales functions in farmerController
Route::get('/farmer-sales/{id}', 'farmerController@farmerSales');
Route::get('/edit-sale/{id}', 'farmerController@editSale');
Route::post('/edit-forFarmerSale', 'farmerController@editSaleDetails');
