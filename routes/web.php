<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::get('/categories', [
    'uses' => 'CategoryController@show',
    'as' => 'categories.show'
]);

Route::get('/categories/{id}', [
    'uses' => 'CategoryController@showItems',
    'as' => 'category.show'
]);

Route::get('/products', [
    'uses' => 'ProductController@show',
    'as' => 'products.show'
]);

Route::get('/products{id}', [
    'uses' => 'ProductController@showProducts',
    'as' => 'product.show'
]);

Route::get('/add-to-cart/{id}', [
    'uses' => 'ProductController@getAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('/increase-by-one/{id}', [
    'uses' => 'ProductController@getIncreaseByOne',
    'as' => 'product.increaseByOne'
]);

Route::get('/reduce/{id}', [
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}', [
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove'
]);

Route::get('/shopping-cart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('/email', [
    'uses' => 'EmailController@show',
    'as' => 'email.show'
]);

Route::post('/email', [
    'uses' => 'EmailController@sendEmail',
    'as' => 'email.sendEmail'
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkout', [
        'uses' => 'ProductController@getCheckout',
        'as' => 'checkout'
    ]);

    Route::post('/checkout', [
        'uses' => 'ProductController@postCheckout',
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
