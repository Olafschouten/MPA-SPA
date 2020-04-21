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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/categories',  'CategoriesController@show');

Route::get('/categories/{id}',  'CategoriesController@showItems');

Route::get('/products',  'ProductsController@show');

Route::get('/products/{id}',  'ProductsController@showProducts');


Route::get('/register', [
    'uses' => 'UserController@getRegister',
    'as' => 'user.register'
]);

Route::post('/register', [
    'uses' => 'UserController@postRegister',
    'as' => 'user.register'
]);

//Route::get('/login', [
//    'user' => 'UserController@signIn',
//    'as' => 'user.login'
//]);
//
//Route::post('/register', [
//    'user' => 'UserController@postRegister',
//    'as' => 'user.register'
//]);
