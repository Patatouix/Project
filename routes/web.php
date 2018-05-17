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
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('user', 'UserController');
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::resource('article', 'ArticleController');
Route::get('article/tag/{tag}', 'ArticleController@indexTag');

Route::resource('command', 'CommandController', ['except' => ['create', 'store']]);
Route::get('command/create/{article}', 'CommandController@create')->name('command.create');
Route::get('command/store/{article}', 'CommandController@store')->name('command.store');

Route::resource('animal', 'AnimalController');

Route::resource('rdv', 'RdvController');
Route::get('rdv/{rdv}/confirm', 'RdvController@confirm')->name('rdv.confirm');
