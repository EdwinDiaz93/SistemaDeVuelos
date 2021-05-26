<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAerolineaRedsocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aerolinea_redsocial', function (Blueprint $table) {            
            $table->String("aerolinea_cod");
            $table->foreignId('redsocial_id')->references('idRedSocial')->on('red_socials')->onDelete('cascade')->nullable();
            $table->foreign('aerolinea_cod')->references('codAeroLinea')->on('aero_lineas')->onDelete('cascade')->nullable();
            $table->String("url")->nullable();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aerolinea_redsocial');
    }
}
