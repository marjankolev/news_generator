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


Route::get('/bitcoin', 'newsController@bitcoinNews');
Route::post('/bitcoin', 'newsController@filterBitcoinNews');
Route::get('/', 'newsController@index');

Route::get('/worldcountriesnews/{country}', 'newsController@countryNews');

Route::get('/techcrunch', 'newsController@techcrunchNews');
Route::post('/techcrunch', 'newsController@filterTechcrunchNews');

Route::get('/walstreet', 'newsController@walstreetNews');
Route::post('/walstreet', 'newsController@filterWalstreetNews');



