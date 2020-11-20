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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('usuarios', 'UserController');
Route::resource('categoria', 'CategoriaController');
Route::resource('articulo', 'ArticuloController');
Route::resource('cliente', 'ClienteController');
Route::resource('proveedor', 'ProveedorController');
Route::resource('ingreso', 'IngresoController');
Route::resource('venta', 'VentaController');
Route::resource('DatosTienda', 'DatosTiendaController');

Route::post('/update', 'DatosTiendaController@update')->name('update');
Route::post('/updatelogo', 'DatosTiendaController@updatelogo')->name('updatelogo');
Route::post('/consultarcuit', 'ClienteController@consultarcuit')->name('consultarcuit');
Route::post('/lastVoucher', 'VentaController@lastVoucher')->name('lastVoucher');

