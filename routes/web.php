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
    return view('home');
});

Auth::routes();

Route::prefix('adm')->group(function(){
    Route::get('/statistics', 'StatisticsController@index')->name('adm.statistic');
    Route::get('/statistics/restaurant', 'StatisticsController@restaurant')->name('restaurant.statistic');
    Route::get('/statistics/saucers', 'StatisticsController@saucers')->name('saucers.statistic');
    Route::post('/saucers/add/{id}', 'RestaurantSaucersController@add')->name('saucers.add');
    Route::post('/saucers/remove/{id}', 'RestaurantSaucersController@remove')->name('saucers.remove');
    Route::post('/restaurant/picture/add/{id}', 'RestaurantController@pictureAdd')->name('picture.add');
    Route::post('/restaurant/picture/remove/{id}', 'RestaurantController@pictureRemove')->name('picture.remove');
    Route::resource('restaurant', 'RestaurantController');
    
});

Route::get('/home', 'HomeController@index')->name('home');
