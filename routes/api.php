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

Route::group(['namespace' => 'Api'], function () {

    Route::post('/login', 'AuthController@login');


    // Discussions
    Route::get('/categories', 'AppController@categories')->name('categories.index');
    Route::get('/governorates', 'AppController@governorates')->name('governorates.index');
    Route::get('/cities', 'AppController@cities')->name('cities.index');
    Route::get('/centers', 'AppController@centers')->name('centers.index');
    Route::get('/nearest-centers', 'AppController@nearestCenters')->name('nearestCenters.index');

});
