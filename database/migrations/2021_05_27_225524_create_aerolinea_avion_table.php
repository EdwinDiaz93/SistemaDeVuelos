<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAerolineaAvionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aerolinea_avion', function (Blueprint $table) {
            $table->String("aerolinea_cod");
            $table->foreignId('avion_id')->references('idAvion')->on('avions')->onDelete('cascade')->nullable();
            $table->foreign('aerolinea_cod')->references('codAeroLinea')->on('aero_lineas')->onDelete('cascade')->nullable();
            $table->integer("cantidad");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aerolinea_avion');
    }
}
