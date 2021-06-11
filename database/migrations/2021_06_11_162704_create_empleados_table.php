<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements("idempleado");  
            $table->integer('idpersona')->unsigned();   
            $table->String('puesto',25)->nullable;
            $table->float('salario',8,4)->nullable;
            $table->boolean('condicion')->default(1);
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
        Schema::dropIfExists('empleados');
    }
}
