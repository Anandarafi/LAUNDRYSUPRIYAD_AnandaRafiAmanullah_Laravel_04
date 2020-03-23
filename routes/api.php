<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|-----------------------------------------------------------------------|
|                         LOGIN PETUGAS TATIB                           |
|-----------------------------------------------------------------------|
*/
Route::post('login','UserController@login');
Route::get('/login/check', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                         CRUD PETUGAS TATIB                            |
|-----------------------------------------------------------------------|
*/
Route::post('petugas','UserController@store');
Route::put('petugas/{id}','UserController@update');
Route::delete('petugas/{id}','UserController@delete');
Route::get('petugas','UserController@tampil');

/*
|-----------------------------------------------------------------------|
|                           CRUD JENIS CUCI                             |
|-----------------------------------------------------------------------|
*/
Route::post('jenis','JenisController@store')->middleware('jwt.verify');
Route::put('jenis/{id}','JenisController@update')->middleware('jwt.verify');
Route::delete('jenis/{id}','JenisController@delete')->middleware('jwt.verify');
Route::get('jenis','JenisController@tampil')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                           CRUD PELANGGAN                              |
|-----------------------------------------------------------------------|
*/
Route::post('pelanggan','PelangganController@store')->middleware('jwt.verify');
Route::put('pelanggan/{id}','PelangganController@update')->middleware('jwt.verify');
Route::delete('pelanggan/{id}','PelangganController@delete')->middleware('jwt.verify');
Route::get('pelanggan','PelangganController@tampil')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                           CRUD Transaksi                              |
|-----------------------------------------------------------------------|
*/
Route::post('transaksi','TransaksiController@store')->middleware('jwt.verify');
Route::put('transaksi/{id}','TransaksiController@update')->middleware('jwt.verify');
Route::delete('transaksi/{id}','TransaksiController@delete')->middleware('jwt.verify');
Route::post('transaksi_detail','TransaksiController@tampil')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                           CRUD Detail Transaks                        |
|-----------------------------------------------------------------------|
*/
Route::post('detail','TransaksiController@store1');
Route::put('detail/{id}','TransaksiController@update1')->middleware('jwt.verify');
Route::delete('detail/{id}','TransaksiController@delete1')->middleware('jwt.verify');
Route::get('detail','TransaksiController@tampil1')->middleware('jwt.verify');