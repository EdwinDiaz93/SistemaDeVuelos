<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->integer('idpersona')->unsigned();
            $table->String('puesto',25);
            $table->float('salario',4,2);
            $table->boolean('estado')->default(1);
           // $table->timestamps();

            $table->foreign('idpersona')->references('idpersona')->on('persona');
    });
  }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
}
