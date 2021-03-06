<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avions', function (Blueprint $table) {
            $table->bigIncrements('idavion');            
            $table->String("modeloavion");
            $table->String("marcaavion");
            $table->String("aerolinea_cod");
            $table->integer("cantidad");
            $table->boolean('estado')->default(1);
            $table->foreignId('tipoavion_id')->references('idtipoavion')->on('tipo_avions')->onDelete('cascade');
            $table->foreign('aerolinea_cod')->references('codaerolinea')->on('aero_lineas')->onDelete('cascade');
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
        Schema::dropIfExists('avions');
    }
}
