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
    return view('/contenido/contenido');
});

// Rutas de avion
Route::get('/avion', 'App\Http\Controllers\AvionController@index');
Route::post('/avion/registrar', 'App\Http\Controllers\AvionController@store');
Route::put('/avion/actualizar', 'App\Http\Controllers\AvionController@update');
Route::put('/avion/desactivar', 'App\Http\Controllers\AvionController@desactivar');
Route::put('/avion/activar', 'App\Http\Controllers\AvionController@activar');

// Rutas tipo de avion
Route::get('/tipoavion', 'App\Http\Controllers\TipoAvionController@index');
Route::post('/tipoavion/registrar', 'App\Http\Controllers\TipoAvionController@store');
Route::put('/tipoavion/actualizar', 'App\Http\Controllers\TipoAvionController@update');
Route::put('/tipoavion/desactivar', 'App\Http\Controllers\TipoAvionController@desactivar');
Route::put('/tipoavion/activar', 'App\Http\Controllers\TipoAvionController@activar');

// Rutas de redsocial
Route::get('/redsocial', 'App\Http\Controllers\RedSocialController@index');
Route::post('/redsocial/registrar', 'App\Http\Controllers\RedSocialController@store');
Route::put('/redsocial/actualizar', 'App\Http\Controllers\RedSocialController@update');
Route::put('/redsocial/desactivar', 'App\Http\Controllers\RedSocialController@desactivar');
Route::put('/redsocial/activar', 'App\Http\Controllers\RedSocialController@activar');


Route::resource('/aerolineas', "App\Http\Controllers\AeroLineaController")->names("aerolinea");
Route::resource('aviones', "App\Http\Controllers\AvionController")->names("avion");
Auth::routes();

// Rutas de clase vuelo
Route::get('/clasevuelo', 'App\Http\Controllers\ClaseVueloController@index');
Route::post('/clasevuelo/registrar', 'App\Http\Controllers\ClaseVueloController@store');
Route::put('/clasevuelo/actualizar', 'App\Http\Controllers\ClaseVueloController@update');
Route::put('/clasevuelo/desactivar', 'App\Http\Controllers\ClaseVueloController@desactivar');
Route::put('/clasevuelo/activar', 'App\Http\Controllers\ClaseVueloController@activar');

// Rutas de tipo costo
Route::get('/tipocosto', 'App\Http\Controllers\TipoCostoController@index');
Route::post('/tipocosto/registrar', 'App\Http\Controllers\TipoCostoController@store');
Route::put('/tipocosto/actualizar', 'App\Http\Controllers\TipoCostoController@update');
Route::put('/tipocosto/desactivar', 'App\Http\Controllers\TipoCostoController@desactivar');
Route::put('/tipocosto/activar', 'App\Http\Controllers\TipoCostoController@activar');
Route::get('/tipocosto/selectTipoCosto', 'App\Http\Controllers\TipoCostoController@selectTipoCosto');

// Rutas de rol
Route::get('/rol', 'App\Http\Controllers\RolController@index');
Route::post('/rol/registrar', 'App\Http\Controllers\RolController@store');
Route::put('/rol/actualizar', 'App\Http\Controllers\RolController@update');
Route::put('/rol/desactivar', 'App\Http\Controllers\RolController@desactivar');
Route::put('/rol/activar', 'App\Http\Controllers\RolController@activar');

Route::get('/costos', 'App\Http\Controllers\CostosController@index');
Route::post('/costos/registrar', 'App\Http\Controllers\CostosController@store');
Route::put('/costos/actualizar', 'App\Http\Controllers\CostosController@update');
Route::put('/costos/desactivar', 'App\Http\Controllers\CostosController@desactivar');
Route::put('/costos/activar', 'App\Http\Controllers\CostosController@activar');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
