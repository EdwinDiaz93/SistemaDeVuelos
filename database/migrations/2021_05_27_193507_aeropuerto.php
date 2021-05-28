<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aeropuerto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aeropuerto', function (Blueprint $table) {
            $table->String('codAeropuerto')->unique();
            $table->String('nomAeropuerto');
            $table->char('telefono');
            $table->String('nomResponsable');
            $table->Integer('numBahias');



            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('cuidad_id')->nullable();


            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('set null');
            $table->foreign('cuidad_id')->references('id')->on('cuidad')->onDelete('set null');
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
        Schema::dropIfExists('aeropuerto');
    }
}
