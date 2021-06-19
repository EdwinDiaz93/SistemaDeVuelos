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



Route::middleware(['guest'])->group(function () {
    //
   Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
    Route::post('login','App\Http\Controllers\Auth\LoginController@login')->name('login');
    Route::post('logout','App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/main', function () {
        return view('/contenido/contenido');
    })->name('main');

Route::middleware(['Administrador'])->group(function () {
    // rutas Reserva
    Route::get('/reserva', 'App\Http\Controllers\ReservaController@index');
    Route::post('/reserva/registrar', 'App\Http\Controllers\ReservaController@store');
    Route::put('/reserva/pagar', 'App\Http\Controllers\ReservaController@pay');
    Route::get('/reserva/listarPdf', 'App\Http\Controllers\ReservaController@listarPdf')->name('reservas_pdf');
   

    // Rutas de precio
    Route::get('/vuelo', 'App\Http\Controllers\VueloController@index');
    Route::post('/vuelo/registrar', 'App\Http\Controllers\VueloController@store');
    Route::put('/vuelo/actualizar', 'App\Http\Controllers\VueloController@update');
    Route::put('/vuelo/desactivar', 'App\Http\Controllers\VueloController@desactivar');
    Route::put('/vuelo/activar', 'App\Http\Controllers\VueloController@activar');

    Route::get('/vuelo/listarPdf', 'App\Http\Controllers\VueloController@listarPdf')->name('vuelos_pdf');
    
    // Rutas de precio
    Route::get('/precio', 'App\Http\Controllers\PrecioController@index');
    Route::post('/precio/registrar', 'App\Http\Controllers\PrecioController@store');
    Route::put('/precio/actualizar', 'App\Http\Controllers\PrecioController@update');
    Route::put('/precio/desactivar', 'App\Http\Controllers\PrecioController@desactivar');
    Route::put('/precio/activar', 'App\Http\Controllers\PrecioController@activar');
    
    // Rutas de aerolinea
    Route::get('/aerolinea', 'App\Http\Controllers\AeroLineaController@index');
    Route::post('/aerolinea/registrar', 'App\Http\Controllers\AeroLineaController@store');
    Route::put('/aerolinea/actualizar', 'App\Http\Controllers\AeroLineaController@update');
    Route::put('/aerolinea/desactivar', 'App\Http\Controllers\AeroLineaController@desactivar');
    Route::put('/aerolinea/activar', 'App\Http\Controllers\AeroLineaController@activar');

    Route::get('/aerolinea/listarPdf', 'App\Http\Controllers\AerolineaController@listarPdf')->name('aerolineas_pdf');
    
    /*rutas para el aeropuerto*/
    Route::get('/aeropuerto', 'App\Http\Controllers\AeropuertoController@index');
    Route::post('/aeropuerto/registrar', 'App\Http\Controllers\AeropuertoController@store');
    Route::put('/aeropuerto/actualizar', 'App\Http\Controllers\AeropuertoController@update');
    Route::put('/aeropuerto/desactivar', 'App\Http\Controllers\AeropuertoController@desactivar');
    Route::put('/aeropuerto/activar', 'App\Http\Controllers\AeropuertoController@activar');

    Route::get('/aeropuerto/listarPdf', 'App\Http\Controllers\AeropuertoController@listarPdf')->name('aeropuertos_pdf');
    
    Route::get('/pais/selectPais', 'App\Http\Controllers\PaisController@selectPais');
    Route::get('/ciudad/selectCiudad', 'App\Http\Controllers\CiudadController@selectCiudad');

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
     Route::get('/rol/selectRol', 'App\Http\Controllers\RolController@selectRol');
     
     
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
     
    
     
     Route::get('/costos', 'App\Http\Controllers\CostosController@index');
     Route::post('/costos/registrar', 'App\Http\Controllers\CostosController@store');
     Route::put('/costos/actualizar', 'App\Http\Controllers\CostosController@update');
     Route::put('/costos/desactivar', 'App\Http\Controllers\CostosController@desactivar');
     Route::put('/costos/activar', 'App\Http\Controllers\CostosController@activar');
     
     Route::get('/cliente', 'App\Http\Controllers\ClienteController@index');
     Route::post('/cliente/registrar', 'App\Http\Controllers\ClienteController@store');
     Route::put('/cliente/actualizar', 'App\Http\Controllers\ClienteController@update');
     
     
     Route::get('/empleado', 'App\Http\Controllers\EmpleadoController@index');
     Route::post('/empleado/registrar', 'App\Http\Controllers\EmpleadoController@store');
     Route::put('/empleado/actualizar', 'App\Http\Controllers\EmpleadoController@update');
     Route::put('/empleado/desactivar', 'App\Http\Controllers\EmpleadoController@desactivar');
     Route::put('/empleado/activar', 'App\Http\Controllers\EmpladoController@activar');
     
     Route::get('/user', 'App\Http\Controllers\UserController@index');
     Route::post('/user/registrar', 'App\Http\Controllers\UserController@store');
     Route::put('/user/actualizar', 'App\Http\Controllers\UserController@update');
     Route::put('/user/desactivar', 'App\Http\Controllers\UserController@desactivar');
     Route::put('/user/activar', 'App\Http\Controllers\UserController@activar');
     Route::get('/user/listarPdf', 'App\Http\Controllers\UserController@listarPdf')->name('users_pdf');
});

Route::middleware(['empleado'])->group(function () {
    Route::get('/empleado', 'App\Http\Controllers\EmpleadoController@index');
    Route::post('/empleado/registrar', 'App\Http\Controllers\EmpleadoController@store');
    Route::put('/empleado/actualizar', 'App\Http\Controllers\EmpleadoController@update');
    Route::put('/empleado/desactivar', 'App\Http\Controllers\EmpleadoController@desactivar');
    Route::put('/empleado/activar', 'App\Http\Controllers\EmpladoController@activar');

    Route::get('/cliente', 'App\Http\Controllers\ClienteController@index');
    Route::post('/cliente/registrar', 'App\Http\Controllers\ClienteController@store');
    Route::put('/cliente/actualizar', 'App\Http\Controllers\ClienteController@update');
});

Route::middleware(['cliente'])->group(function () {
    Route::get('/reserva', 'App\Http\Controllers\ReservaController@index');
    Route::post('/reserva/registrar', 'App\Http\Controllers\ReservaController@store');
    Route::put('/reserva/pagar', 'App\Http\Controllers\ReservaController@pay');
    Route::get('/reserva/listarPdf', 'App\Http\Controllers\ReservaController@listarPdf')->name('reservas_pdf');
   

    // Rutas de precio
    Route::get('/vuelo', 'App\Http\Controllers\VueloController@index');
    Route::post('/vuelo/registrar', 'App\Http\Controllers\VueloController@store');
    Route::put('/vuelo/actualizar', 'App\Http\Controllers\VueloController@update');
    Route::put('/vuelo/desactivar', 'App\Http\Controllers\VueloController@desactivar');
    Route::put('/vuelo/activar', 'App\Http\Controllers\VueloController@activar');

    Route::get('/vuelo/listarPdf', 'App\Http\Controllers\VueloController@listarPdf')->name('vuelos_pdf');
});


});

Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
Route::post('login','App\Http\Controllers\Auth\LoginController@login')->name('login');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


