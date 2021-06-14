<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->bigIncrements('idrol');
            $table->String('nomrol',25);
            $table->string('descripcion', 100)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        //DB::table('rol')->insert(array('nomrol'=>'Administrador','descripcion'=>'supervisa los demas empleados'));
        //DB::table('rol')->insert(array('nomrol'=>'Empleado','descripcion'=>'trabajador normal'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol');
    }
}
