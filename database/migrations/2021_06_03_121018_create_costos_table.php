<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costos', function (Blueprint $table) {
            $table->bigIncrements('idcosto');
            $table->integer('idtipocosto')->unsigned();
            $table->float('cantidad');
            $table->string('descripcion', 100);
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('idtipocosto')->references('idtipocosto')->on('tipo_costo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costos');
    }
}
