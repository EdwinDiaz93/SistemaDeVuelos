<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAeropuertoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aeropuerto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codaeropuerto')->unique();
            $table->string('nomaeropuerto')->unique();
            $table->string('telefono');
            $table->string('nomresponsable');
            $table->integer('numbahias');
            $table->boolean('estado')->default(1);
            $table->integer('idpais')->unsigned();;
            $table->integer('idciudad')->unsigned();
            $table->timestamps();

            $table->foreign('idpais')->references('idpais')->on('pais');
            $table->foreign('idciudad')->references('idciudad')->on('ciudad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aeropuerto');
    }
}
