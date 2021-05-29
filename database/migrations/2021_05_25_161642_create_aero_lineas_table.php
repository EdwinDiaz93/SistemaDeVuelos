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
            $table->String('codaerolinea')->unique();
            $table->String('nombreaerolinea');
            $table->String('nombreoficial');
            $table->String('nombrecorto');
            $table->String('nombrerepresentante');
            $table->date('fechafundacion');
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
