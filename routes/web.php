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
})->name('home');

Auth::routes();

Route::get('/init', 'Backend\InitController@index')->name('init');

Route::get('/', 'PageController@home');

Route::post('/feedback', 'PageController@feedback')->name('feedback');

Route::get('/{word}', 'PageController@show');
Route::get('/{word}/{word2}', 'PageController@show');
Route::get('/{word}/{word2}/{word3}', 'PageController@show');
Route::get('/{word}/{word2}/{word3}/{word4}', 'PageController@show');