<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePruebasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pruebas', function (Blueprint $table) {
           
            $table->bigIncrements('idprueba');
            $table->integer('idhorario')->unsigned();
            $table->String('nombrep',20);
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('idhorario')->references('idhorario')->on('horario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pruebas');
    }
}
