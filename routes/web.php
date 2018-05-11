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


Route::get('/', 'ArticalController@home');
Route::get('admin', 'AdminController@index');
Route::post('carousels', 'AdminController@carousels');
Route::get('about', 'ArticalController@about');
Route::get('news', 'ArticalController@news');
Route::get('news/detail/{id}', 'ArticalController@show');

Route::resource('artical', 'ArticalController')->except(['create','edit']);
Route::post('artical/upload', 'ArticalController@artical_imgs_upload');
Route::post('contact', 'ContactController@store');
Route::delete('contact/{id}', 'ContactController@destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
