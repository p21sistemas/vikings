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

Route::any('/cartorios/search', 'CartorioController@search')->name('cartorios.search');
Route::post('/cartorios/import-data-xml', 'CartorioController@importDataXML')->name('cartorios.import-data-xml');
Route::post('/cartorios/export-data-excel', 'CartorioController@exportDataExcel')->name('cartorios.export-data-excel');

Route::resource('cartorios', 'CartorioController');
