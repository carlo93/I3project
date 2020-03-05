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

    if (!Auth::check()) {

        return redirect('login');
    }

    return redirect('/login');
});

Auth::routes(['register' => true]);

Route::get('/home/{id}', ['as' => 'transaction.slave', 'uses' => 'TransactionController@show']);
Route::get('/home', ['as' => 'transaction.master', 'uses' => 'TransactionController@index']);
Route::get('/home/create/{id}', ['as' => 'transaction.create', 'uses' => 'TransactionController@create']);
Route::post('/home/store/{id}', ['as' => 'transaction.store', 'uses' => 'TransactionController@store']);

Route::get('/home/export/{id}', ['as' => 'transaction.export', 'uses' => 'TransactionController@export']);
