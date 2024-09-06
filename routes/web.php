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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::post('roles/store', ['as'=>'role.store', 'uses' => 'HomeController@role_store']);

Route::post('roles/store', 'HomeController@role_store')->name('role.store');

// Route::delete('roles/delete/{id}', 'HomeController@role_delete')->name('role.delete');

Route::delete('roles/delete/{id}', 'HomeController@role_delete')->name('role.delete');

Route::post('roles/edit', 'HomeController@role_edit')->name('role.edit');