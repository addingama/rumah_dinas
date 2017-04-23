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
        return redirect('/login');
    } else {
        return redirect('/dashboard');
    }
});


Route::get('login', 'SessionsController@login')->name('login');
Route::post('login', 'SessionsController@doLogin');

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', 'SessionsController@logout');
    Route::get('dashboard', 'DashboardController@index');

    Route::resource('rumah', 'RumahController');
    Route::post('rumah/import', 'RumahController@import');
    Route::resource('tipe_rumah', 'TipeRumahController');
    Route::post('tipe_rumah/import', 'TipeRumahController@import');
    Route::resource('pegawai', 'PegawaiController');
    Route::resource('pangkat', 'PangkatController');

    Route::resource('peminjaman', 'PeminjamanController');

});