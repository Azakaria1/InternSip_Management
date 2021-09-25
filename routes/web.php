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
    return view('home');
});


Route::get('/users', function () {
    return view('users.index');
})->name('users.index');


Route::get('/stage/historique', function () {
    return view('stages.historique');
})->name('stages.historique');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('stagiaires', App\Http\Controllers\StagiaireController::class);
    Route::resource('sujets', App\Http\Controllers\SujetController::class);
    Route::resource('stages', App\Http\Controllers\StageController::class);
    Route::resource('departements', App\Http\Controllers\DepartementController::class);
    Route::resource('services', App\Http\Controllers\ServiceController::class);

    Route::post('/departements/search/', 'App\Http\Controllers\DepartementController@search')->name('departements.search');
    Route::post('/users/search/', 'App\Http\Controllers\UserController@search')->name('users.search');
    Route::post('/roles/search/', 'App\Http\Controllers\RoleController@search')->name('roles.search');
    Route::post('/services/search/', 'App\Http\Controllers\ServiceController@search')->name('services.search');
    Route::post('/stagiaires/search/', 'App\Http\Controllers\StagiaireController@search')->name('stagiaires.search');
    Route::post('/sujets/search/', 'App\Http\Controllers\SujetController@search')->name('sujets.search');
    Route::post('/stages/search/', 'App\Http\Controllers\StageController@search')->name('stages.search');

    Route::get('/profil', [App\Http\Controllers\UserController::class, 'profil'])->name('profil');

});