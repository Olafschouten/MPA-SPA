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

Route::get('/', [
    'uses' => 'WelcomeController@getIndex',
    'as' => 'home.welcome'
]);

Route::get('/categories', 'CategoriesController@show');

Route::get('/categories/{id}', 'CategoriesController@showItems');

Route::get('/products', 'ProductsController@show');

Route::get('/products/{id}', 'ProductsController@showProducts');

Route::get('/add-to-cart/{id}', [
    'uses' => 'ProductsController@getAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('/increase-by-one/{id}', [
    'uses' => 'ProductsController@getIncreaseByOne',
    'as' => 'product.increaseByOne'
]);

Route::get('/reduce/{id}', [
    'uses' => 'ProductsController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}', [
    'uses' => 'ProductsController@getRemoveItem',
    'as' => 'product.remove'
]);

Route::get('/shopping-cart', [
    'uses' => 'ProductsController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkout', [
        'uses' => 'ProductsController@getCheckout',
        'as' => 'checkout'
    ]);

    Route::post('/checkout', [
        'uses' => 'ProductsController@postCheckout',
        'as' => 'checkout'
    ]);
});

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [
            'uses' => 'UserController@getRegister',
            'as' => 'user.register'
        ]);

        Route::post('/register', [
            'uses' => 'UserController@postRegister',
            'as' => 'user.register'
        ]);

        Route::get('/login', [
            'uses' => 'UserController@getLogin',
            'as' => 'user.login'
        ]);

        Route::post('/login', [
            'uses' => 'UserController@postLogin',
            'as' => 'user.login'
        ]);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [
            'uses' => 'UserController@getProfile',
            'as' => 'user.profile'
        ]);

        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);
    });
});
