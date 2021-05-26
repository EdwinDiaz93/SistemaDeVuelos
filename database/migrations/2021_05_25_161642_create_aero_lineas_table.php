<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAeroLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aero_lineas', function (Blueprint $table) {            
            $table->String('codAeroLinea')->unique();
            $table->String('NombreAeroLinea');
            $table->String('NombreOficial');
            $table->String('NombreCorto');
            $table->String('NombreRepresentante');
            $table->date('FechaFundacion');
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
        Schema::dropIfExists('aerolinea');
    }
}
