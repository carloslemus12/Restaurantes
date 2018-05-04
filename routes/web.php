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

    Route::resource('saucer','SaucersController');
    Route::post('/saucer/destroy/{id}','SaucersController@destroy')->name('saucer.destroy');
    Route::post('/saucer/picture2/add/{id}', 'SaucersController@pictureAdd')->name('picture2.add');
    Route::post('/saucer/picture2/remove/{id}', 'SaucersController@pictureRemove')->name('picture2.remove');

    Route::resource('advertisement','AdvertisementController');
    Route::post('/advertisement/destroy/{id}','AdvertisementController@destroy')->name('advertisement.destroy');
});

Route::prefix('cli')->group(function(){
    Route::get('/restaurants', 'RestaurantController@client')->name('cli.restaurants');
    Route::get('/restaurant/{id}', 'ClientController@restaurant')->name('cli.restaurant');
    Route::get('/restaurant/light/comments/{id}', 'ClientController@getComentarios')->name('cli.commentslight');
    Route::get('/restaurant/comments/{id}', 'ClientController@comentarios')->name('cli.comments');

    Route::get('/restaurant/recommendations/{id}', 'ClientController@recomendaciones')->name('cli.recommendations');
    Route::get('/restaurant/light/recommendations/{id}', 'ClientController@getRecomendaciones')->name('cli.recommendationslight');

    Route::post('/restaurant/recommendations/add/{id}', 'ClientController@addRecomendacion')->name('cli.restaurantRecommendations');
    Route::post('/restaurant/recommendations/delete/{id}', 'ClientController@removeRecomendacion')->name('cli.deleteRecommendations');

    Route::post('/restaurant/comment/add/{id}', 'ClientController@addComentario')->name('cli.restaurantComment');
    Route::post('/restaurant/comment/delete/{id}', 'ClientController@removeComentario')->name('cli.deleteComment');
    Route::post('/restaurant/star/{id}', 'ClientController@start')->name('cli.start');
});

Route::get('/home', 'HomeController@index')->name('home');
