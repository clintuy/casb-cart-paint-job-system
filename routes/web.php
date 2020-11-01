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
    return Redirect::to( '/new-paint-job');
});

Route::get('/new-paint-job', 'NewPaintJobController@index')->name('new-paint.index');
Route::post('/new-paint-job', 'NewPaintJobController@store')->name('new-paint.store');



Route::get('/paint-job', 'PaintJobController@index')->name('paint.index');
Route::put('/paint-job', 'PaintJobController@update')->name('paint.update');
