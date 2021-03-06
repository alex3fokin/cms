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

Auth::routes();

Route::get('/', 'PageController@home')->name('home');

Route::post('/feedback', 'PageController@feedback')->name('feedback');

Route::get('/sitemap.xml', 'PageController@sitemap')->name('sitemap');
Route::get('/{word}', 'PageController@show');
Route::get('/{word}/{word2}', 'PageController@show');
Route::get('/{word}/{word2}/{word3}', 'PageController@show');
Route::get('/{word}/{word2}/{word3}/{word4}', 'PageController@show');