<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->bigIncrements('idpersona');
            $table->String('pnombre',25);
            $table->string('snombre', 25);
            $table->String('papellido',25);
            $table->string('sapellido', 25);
            $table->date('fechanaci');
            $table->string('direccion', 50)->nullable();
            $table->String('telefono',25)->nullable();
            $table->string('movil', 25)->nullable();
           // $table->boolean('estado')->default(1);
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
