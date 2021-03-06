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

    Route::resource('permits','PermitsController');
    Route::post('permits/add/{id}','PermitsController@add');

    Route::resource('gifts','GiftsController');
     Route::post('/gifts/destroy/{id}','GiftsController@destroy')->name('gifts.destroy');

});

Route::prefix('cli')->group(function(){
    Route::get('/saucer/stars/{id}', 'RestaurantController@getStars')->name('cli.getSaucerStars');
    Route::get('/restaurants/stars/{id}', 'SaucersController@getStars')->name('cli.getRestaurantStars');

    // Restaurantes ////////////////////////////////////////////////////////////////////////////////////////////
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

    // Platillos //////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/saucers', 'SaucersController@client')->name('cli.saucers');
    Route::get('/saucer/{id}', 'ClientController@saucer')->name('cli.saucer');
    Route::get('/saucer/light/comments/{id}', 'ClientController@getSaucerComentarios')->name('cli.saucercommentslight');
    Route::get('/saucer/comments/{id}', 'ClientController@saucerComentarios')->name('cli.saucerComments');

    Route::get('/saucer/recommendations/{id}', 'ClientController@saucerRecomendaciones')->name('cli.saucerRecommendations');
    Route::get('/saucer/light/recommendations/{id}', 'ClientController@getSaucerRecomendaciones')->name('cli.saucerRecommendationslight');

    Route::get('/advertisements', 'ClientController@advertisements')->name('cli.advertisements');
    Route::get('/awards', 'ClientController@awards')->name('cli.awards');

    Route::post('/saucer/comment/add/{id}', 'SaucersController@addComentario')->name('cli.saucersComment');
    Route::post('/saucer/comment/delete/{id}', 'SaucersController@removeComentario')->name('cli.saucersDeleteComment');

    Route::post('/saucer/recommendations/add/{id}', 'SaucersController@addRecomendacion')->name('cli.saucerAddRecommendations');
    Route::post('/saucer/recommendations/delete/{id}', 'SaucersController@removeRecomendacion')->name('cli.saucerDeleteRecommendations');

    Route::post('/saucer/star/{id}', 'SaucersController@start')->name('cli.saucerStart');
});

Route::prefix('mod')->group(function(){

    Route::get('/modsaucer/create','ModsaucersController@create')->name('mod.modsaucers.create');
    Route::post('/modsaucer/destroy/{id}','ModsaucersController@destroy')->name('modsaucer.destroy');    
    Route::get('/modsaucers/{id}','ModsaucersController@index')->name('mod.modsaucers');
    Route::get('/modsaucer/{id}','ModsaucersController@show');
    Route::post('/modsaucer/picture/add/{id}','ModsaucersController@pictureAdd')->name('picture.add');
    Route::post('/modsaucer/picture/remove/{id}','ModsaucersController@pictureRemove')->name('picture.remove');
    Route::get('/modsaucers/comments/{id}','ModsaucersController@comments');

    Route::post('/comments/delete/{id}','ModsaucersController@delete')->name('comments.delete');
   
    Route::resource('modsaucers','ModsaucersController');

    Route::post('/modemployes/add/{id}','ModemployesController@add');
    Route::get('/modemployes/{id}','ModemployesController@index');

    Route::get('/recommendation/{id}','RecommendationController@list');
    Route::post('/recommendation/destroy/{id}','RecommendationController@destroy')->name("recommendation.destroy");

});

Route::get('/home', 'HomeController@index')->name('home');
