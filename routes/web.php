<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
Route::resource('products', 'ProductController')->middleware('auth');
Route::resource('categories', 'CategoryController')->middleware('auth');
Route::resource('orders', 'OrderController')->middleware('auth');