<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('idpersona');
            $table->string('pnombre', 25);
            $table->string('snombre', 25)->nullable;
            $table->string('papellido', 25)->nullable;
            $table->string('sapellido', 25)->nullable;
            $table->string('dui', 25)->nullable;
            $table->string('nit', 25);
            $table->string('pasaporte', 25)->nullable;
            $table->Date('fechanaci');
            $table->string('direccion', 50)->nullable;
            $table->string('telefono', 25);
            $table->string('movil', 25);
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
        Schema::dropIfExists('persona');
    }
}
