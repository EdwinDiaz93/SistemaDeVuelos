<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements("idcliente");  
            $table->integer('idpersona')->unsigned();   
            $table->String('estadocivil',25)->nullable;
            $table->String('genero',25)->nullable;
            $table->String('nomcontacto',25)->nullable;
            $table->String('numfrecuente',12)->nullable;
            $table->timestamps();
            $table->foreign('idpersona')->references('idpersona')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
