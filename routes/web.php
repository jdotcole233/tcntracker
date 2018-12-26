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

Route::get('/signin', 'externalresourceController@signin');

Route::get('/companysignupregistration', 'externalresourceController@signup');

Route::get('/dashboard', 'PagesController@index');

Route::get('/farmer-profile', 'PagesController@farmerProfile');

Route::get('/buyer-profile', 'PagesController@buyerProfile');

Route::get('/create-buyer', 'PagesController@createBuyer');


Route::get('/farmers', 'PagesController@farmers');

Route::get('/create-farmer', 'PagesController@createFarmer');

// Route::get('/view-farmer/{id}', 'PagesController@viewFarmer');


Route::get('/communities', 'PagesController@communities');

Route::get('/create-community', 'PagesController@createCommunity');











// Community controller functions
Route::post('/register_community','communityController@register_community');
Route::get('/fetch_communities','communityController@list_out_communities');
Route::get('/view-community/{id}', 'communityController@list_community');
Route::get('/edit-community/{id}', 'communityController@editCommunity');
Route::post('/edit-forCommunity', 'communityController@update_community_details');

Route::get('/add-price/{id}', 'PagesController@addPrice');
Route::post('/add_priceto_community', 'communityController@add_priceto_community');
Route::get('/community-prices/{id}', 'communityController@communityPrices');
Route::get('/update-price/{id}', 'communityController@updatePrice');
Route::post('/update_current_price', 'communityController@update_current_prices');




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
Route::get('/create-sale/{id}', 'farmerController@createSale');


//farmer sales functions in farmerController
Route::get('/farmer-sales/{id}', 'farmerController@farmerSales');
Route::get('/edit-sale/{id}', 'farmerController@editSale');
Route::post('/edit-forFarmerSale', 'farmerController@editSaleDetails');


//ussd endpoint
Route::post('/fussd_interact', 'ussdController@farmerapplicationcontrol');

//log
Route::post('/register_com', 'otherController@createCompanyAccount');
