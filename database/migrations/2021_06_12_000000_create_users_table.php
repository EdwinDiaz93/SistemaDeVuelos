<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('idusuario');
           
            $table->integer('idpersona')->unsigned();
            $table->foreign('idpersona')->references('idpersona')->on('personas')->onDelete('cascade');
            
            $table->string('nomusuario');
            $table->string('password');
            $table->string('email')->unique();
            $table->boolean('estado')->default(1);

            $table->integer('idrol')->unsigned();
            $table->foreign('idrol')->references('idrol')->on('rol');

            $table->rememberToken();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
