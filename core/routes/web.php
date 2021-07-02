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

Route::prefix('admin')->group(function () {
    Route::get('/', ['as' => 'login', 'uses' => 'LoginController@index']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
    Route::post('postlogin', ['as' => 'post.login', 'uses' => 'LoginController@post']);
});

Route::group(['middleware' => ['auth', 'checkRole:superadmin']], function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('master-data')->group(function () {
            Route::prefix('user')->group(function () {
                Route::get('/', ['as' => 'user', 'uses' => 'UserController@index']);
                Route::get('add', ['as' => 'user.add', 'uses' => 'UserController@add']);
                Route::get('edit/{id}', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
                Route::get('destroy', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
                Route::post('store', ['as' => 'user.store', 'uses' => 'UserController@store']);
                Route::post('update/{id}', ['as' => 'user.update', 'uses' => 'UserController@update']);
            });
        });
    });
});

Route::group(['middleware' => ['auth', 'checkRole:superadmin,Admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);
        });
        Route::prefix('kalender')->group(function () {
            Route::get('/', ['as' => 'kalender', 'uses' => 'DashboardController@kalender']);
            Route::get('getEvent', ['as' => 'getEvent', 'uses' => 'DashboardController@getEvent']);
        });

        Route::prefix('master-data')->group(function () {
            Route::prefix('lokasi')->group(function () {
                Route::get('/', ['as' => 'lokasi', 'uses' => 'LokasiController@index']);
                Route::get('add', ['as' => 'lokasi.add', 'uses' => 'LokasiController@add']);
                Route::get('detail/{id}', ['as' => 'lokasi.detail', 'uses' => 'LokasiController@detail']);
                Route::get('destroy', ['as' => 'lokasi.destroy', 'uses' => 'LokasiController@destroy']);
                Route::post('store', ['as' => 'lokasi.store', 'uses' => 'LokasiController@store']);
            });
        });

        Route::prefix('event')->group(function () {
            Route::get('/', ['as' => 'event', 'uses' => 'EventController@index']);
            Route::get('getDate', ['as' => 'event.date', 'uses' => 'EventController@getDateDiff']);
            Route::get('data/{status}', ['as' => 'event.data', 'uses' => 'EventController@data']);
            Route::get('data/edit/{id}', ['as' => 'event.edit', 'uses' => 'EventController@edit']);
            Route::get('{id}', ['as' => 'event.detail', 'uses' => 'EventController@detail']);
            Route::get('delete/destroy', ['as' => 'event.destroy', 'uses' => 'EventController@destroy']);
            Route::post('store', ['as' => 'event.store', 'uses' => 'EventController@store']);
            Route::post('update/{id}', ['as' => 'event.update', 'uses' => 'EventController@update']);
        });

        Route::prefix('laporan')->group(function () {
            Route::get('/', ['as' => 'laporan', 'uses' => 'EventController@laporan']);
            Route::get('cetak', ['as' => 'laporan.cetak', 'uses' => 'EventController@laporanCetak']);
        });

    });
});
