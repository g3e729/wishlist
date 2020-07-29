<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PageController@index')->name('home');
Route::get('login', 'PageController@index')->name('login');
	
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'PageController@register')->name('register.show');
Route::post('register', 'PageController@storeRegister')->name('register.store');
Route::get('view/{code}', 'PageController@shared')->name('wishlists.shared');

Route::group([
    'middleware' => ['auth'],
], function () {
	Route::post('items/{wishlist}/store', 'WishlistItemController@store')
		->name('items.store');
	Route::patch('items/{item}/update', 'WishlistItemController@update')
		->name('items.update');
    Route::delete('items/{item}/delete', 'WishlistItemController@destroy')->name('items.destroy');

	Route::get('my-wishlists', 'WishlistController@myList')->name('wishlists.mine');

	Route::get('wishlists', 'WishlistController@index')->name('wishlists.participated');
	Route::post('wishlists/store', 'WishlistController@store')->name('wishlists.store');
	Route::post('wishlists/{wishlist}/update', 'WishlistController@update')->name('wishlists.update');
	Route::delete('wishlists/{wishlist}/delete', 'WishlistController@destroy')->name('wishlists.destroy');
	Route::post('wishlists/{wishlist}/invite', 'WishlistController@invite')->name('wishlists.invite');
	Route::delete('wishlists/{wishlist}/{participant}/delete', 'WishlistController@uninvite')->name('wishlists.invite.destroy');
	Route::get('wishlists/{wishlist}', 'WishlistController@show')->name('wishlists.show');

	Route::get('to-buy/list', 'BuyingController@index')->name('items.index');
	Route::patch('to-buy/{item}/update', 'BuyingController@update')->name('items.to-buy');
	Route::patch('to-buy/{item}/remove', 'BuyingController@remove')->name('items.remove');
	Route::patch('to-buy/{item}/purchased', 'BuyingController@purchased')->name('items.purchased');
	Route::patch('to-buy/{item}/unpurchased', 'BuyingController@unpurchased')->name('items.unpurchased');
});

Route::view('erd', 'erd');