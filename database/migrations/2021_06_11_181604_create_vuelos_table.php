<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            $table->bigIncrements('idvuelo');
            $table->String("aerolinea_cod");
            $table->integer('idprecio');
            $table->integer('costo_id');
            $table->integer('idhorariosalida');
            $table->integer('idhorarioregreso');
            $table->integer('idaeropuertoida');
            $table->integer('idaeropuertoregreso');
            $table->integer('idclasevuelo');
            $table->integer('millasreales');
            $table->integer('millasotorgadas');
            $table->boolean('estado')->default(1);
            $table->integer('idciudadorigen');
            $table->integer('idciudaddestino');
            
            $table->foreign('idciudadorigen')->references('idciudad')->on('ciudad');            
            $table->foreign('idciudaddestino')->references('idciudad')->on('ciudad');            
            $table->foreign('aerolinea_cod')->references('codaerolinea')->on('aero_lineas')->onDelete('cascade');
            $table->foreign('idprecio')->references('idprecio')->on('precios')->onDelete('cascade');
            $table->foreign('idhorariosalida')->references('idhorario')->on('horario')->onDelete('cascade');
            $table->foreign('idhorarioregreso')->references('idhorario')->on('horario')->onDelete('cascade');
            $table->foreign('idaeropuertoida')->references('id')->on('aeropuerto')->onDelete('cascade');
            $table->foreign('idaeropuertoregreso')->references('id')->on('aeropuerto')->onDelete('cascade');
            $table->foreign('costo_id')->references('idcosto')->on('costos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vuelos');
    }
}
