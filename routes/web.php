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

//laravel welcome view
Route::get('/', function () {
    return view('welcome');
});

//admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/home', '\App\Http\Controllers\Admin\HomeController@index')->name('adminHome');

    Route::resource('user', '\App\Http\Controllers\Admin\UserController', [
        'as' => 'admin'
    ]);
    Route::post('user/session', '\App\Http\Controllers\Admin\UserController@updateSession');

    Route::resource('conseil', '\App\Http\Controllers\Admin\ConseilController', [
        'as' => 'admin'
    ]);
    Route::get('parametres', '\App\Http\Controllers\Admin\ConseilController@parametres')->name('admin.parametres');
    Route::post('parametres/conseiltag/store', '\App\Http\Controllers\Admin\ConseilController@conseiltagStore')->name('admin.parametres.conseiltag.store');
    Route::post('parametres/age/store', '\App\Http\Controllers\Admin\ConseilController@ageStore')->name('admin.parametres.age.store');
    Route::post('parametres/environment/store', '\App\Http\Controllers\Admin\ConseilController@environmentStore')->name('admin.parametres.environment.store');
    Route::post('parametres/espece/store', '\App\Http\Controllers\Admin\ConseilController@especeStore')->name('admin.parametres.espece.store');
    Route::post('parametres/food/store', '\App\Http\Controllers\Admin\ConseilController@foodStore')->name('admin.parametres.food.store');
    Route::post('parametres/gender/store', '\App\Http\Controllers\Admin\ConseilController@genderStore')->name('admin.parametres.gender.store');
    Route::post('parametres/race/store', '\App\Http\Controllers\Admin\ConseilController@raceStore')->name('admin.parametres.race.store');
    Route::post('parametres/sport/store', '\App\Http\Controllers\Admin\ConseilController@sportStore')->name('admin.parametres.sport.store');
    Route::post('parametres/sterilization/store', '\App\Http\Controllers\Admin\ConseilController@sterilizationStore')->name('admin.parametres.sterilization.store');
    Route::post('parametres/weight/store', '\App\Http\Controllers\Admin\ConseilController@weightStore')->name('admin.parametres.weight.store');

    Route::resource('animal', '\App\Http\Controllers\Admin\AnimalController', [
        'as' => 'admin'
    ]);
    Route::post('animal/user', '\App\Http\Controllers\Admin\AnimalController@redirectAnimalUser')->name('admin.animal.user');
    Route::get('animal/user/{user}', '\App\Http\Controllers\Admin\AnimalController@indexAnimalUser');
    Route::resource('produit', '\App\Http\Controllers\Admin\ProduitController', [
        'as' => 'admin'
    ]);

    Route::post('produit/tag', '\App\Http\Controllers\Admin\ProduitController@redirectProduittag')->name('admin.produit.tag');
    Route::get('produit/tag/{tag}', '\App\Http\Controllers\Admin\ProduitController@indexProduittag');
    Route::resource('reservation', '\App\Http\Controllers\Admin\ReservationController', [
        'as' => 'admin'
    ]);

    Route::get('reservation/{reservation}/archive', '\App\Http\Controllers\Admin\ReservationController@archive')->name('admin.reservation.archive');
    Route::post('reservation/status', '\App\Http\Controllers\Admin\ReservationController@redirectReservationStatus')->name('admin.reservation.status');
    Route::get('reservation/status/{status}', '\App\Http\Controllers\Admin\ReservationController@indexReservationStatus');
    Route::resource('rdv', '\App\Http\Controllers\Admin\RdvController', [
        'as' => 'admin'
    ]);

    Route::get('rdv/{rdv}/archive', '\App\Http\Controllers\Admin\RdvController@archive')->name('admin.rdv.archive');
    Route::post('rdv/status', '\App\Http\Controllers\Admin\RdvController@redirectRdvStatus')->name('admin.rdv.status');
    Route::get('rdv/status/{status}', '\App\Http\Controllers\Admin\RdvController@indexRdvStatus');

    Route::get('chat', '\App\Http\Controllers\Admin\ChatController@index');
    Route::post('sendmessage', '\App\Http\Controllers\Admin\ChatController@sendMessage');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user', 'UserController');
Route::post('user/session', 'UserController@updateSession');
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::resource('produit', 'ProduitController');
Route::post('produit/tag', 'ProduitController@redirectProduittag')->name('produit.tag');
Route::get('produit/tag/{tag}', 'ProduitController@indexProduittag');

Route::resource('reservation', 'ReservationController', ['except' => ['create', 'store']]);
Route::get('reservation/create/{produit}', 'ReservationController@create')->name('reservation.create');
Route::get('reservation/store/{produit}', 'ReservationController@store')->name('reservation.store');
Route::get('reservation/{reservation}/archive', 'ReservationController@archive')->name('reservation.archive');
Route::post('reservation/status', 'ReservationController@redirectReservationStatus')->name('reservation.status');
Route::get('reservation/status/{status}', 'ReservationController@indexReservationStatus');

Route::resource('animal', 'AnimalController');

Route::resource('conseil', 'ConseilController');
Route::post('conseil/tag', 'ConseilController@redirectConseiltag')->name('conseil.tag');
Route::get('conseil/tag/{tag}', 'ConseilController@indexConseiltag');

Route::resource('rdv', 'RdvController');
Route::get('rdv/{rdv}/confirm', 'RdvController@confirm')->name('rdv.confirm');
Route::get('rdv/{rdv}/archive', 'RdvController@archive')->name('rdv.archive');
Route::post('rdv/status', 'RdvController@redirectRdvStatus')->name('rdv.status');
Route::get('rdv/status/{status}', 'RdvController@indexRdvStatus');

Route::get('chat', 'ChatController@index');
Route::post('sendmessage', 'ChatController@sendMessage');