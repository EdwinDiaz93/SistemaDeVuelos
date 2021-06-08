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

Route::get('/main', function () {
    return view('/contenido/contenido');
})->name('main');

Route::group(['middleware'=>['guest']],function(){

});

Route::resource('/redsocial',"App\Http\Controllers\RedSocialController")->names("red");
Route::resource('/aerolineas', "App\Http\Controllers\AeroLineaController")->names("aerolinea");
Route::resource('tipoavion', "App\Http\Controllers\TipoAvionController")->names("tipoavion");
Route::resource('aviones', "App\Http\Controllers\AvionController")->names("avion");
Auth::routes();

Route::get('/clasevuelo', 'App\Http\Controllers\ClaseVueloController@index');
Route::post('/clasevuelo/registrar', 'App\Http\Controllers\ClaseVueloController@store');
Route::put('/clasevuelo/actualizar', 'App\Http\Controllers\ClaseVueloController@update');
Route::put('/clasevuelo/desactivar', 'App\Http\Controllers\ClaseVueloController@desactivar');
Route::put('/clasevuelo/activar', 'App\Http\Controllers\ClaseVueloController@activar');

Route::get('/tipocosto', 'App\Http\Controllers\TipoCostoController@index');
Route::post('/tipocosto/registrar', 'App\Http\Controllers\TipoCostoController@store');
Route::put('/tipocosto/actualizar', 'App\Http\Controllers\TipoCostoController@update');
Route::put('/tipocosto/desactivar', 'App\Http\Controllers\TipoCostoController@desactivar');
Route::put('/tipocosto/activar', 'App\Http\Controllers\TipoCostoController@activar');

Route::get('/rol', 'App\Http\Controllers\RolController@index');
Route::post('/rol/registrar', 'App\Http\Controllers\RolController@store');
Route::put('/rol/actualizar', 'App\Http\Controllers\RolController@update');
Route::put('/rol/desactivar', 'App\Http\Controllers\RolController@desactivar');
Route::put('/rol/activar', 'App\Http\Controllers\RolController@activar');

Route::get('/tipodocumento', 'App\Http\Controllers\TipoDocumentoController@index');
Route::post('/tipodocumento/registrar', 'App\Http\Controllers\TipoDocumentoController@store');
Route::put('/tipodocumento/actualizar', 'App\Http\Controllers\TipoDocumentoController@update');
Route::put('/tipodocumento/desactivar', 'App\Http\Controllers\TipoDocumentoController@desactivar');
Route::put('/tipodocumento/activar', 'App\Http\Controllers\TipodocumentoController@activar');

Route::get('/horario', 'App\Http\Controllers\HorarioController@index');
Route::post('/horario/registrar', 'App\Http\Controllers\HorarioController@store');
Route::put('/horario/actualizar', 'App\Http\Controllers\HorarioController@update');
Route::put('/horario/desactivar', 'App\Http\Controllers\HorarioController@desactivar');
Route::put('/horario/activar', 'App\Http\Controllers\HorarioController@activar');

/*rutaS para el login*/ 

Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
Route::post('login','App\Http\Controllers\Auth\LoginController@login')->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
