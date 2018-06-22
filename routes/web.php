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

Route::get('/', 'WelcomeController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
     Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
     Route::resource('items', 'ItemsController');
     Route::group(['prefix' => 'users/{id}'], function () {
          Route::post('favorite', 'ItemFavoritesController@store')->name('item.favorite');
          Route::delete('unfavorite', 'ItemFavoritesController@destroy')->name('item.unfavorite');
          Route::post('purchase', 'ItemPurchaseController@store')->name('item.purchase');
          Route::delete('unpurchase', 'ItemPurchaseController@destroy')->name('item.unpurchase');
          Route::get('purchases', 'UsersController@purchases')->name('users.purchases');
     // Route::post('/upload', 'ItemsController@upload');
});

});