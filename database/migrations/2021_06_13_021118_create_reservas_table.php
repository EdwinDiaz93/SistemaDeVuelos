<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements("idreserva");
            $table->integer("cliente_id");
            $table->integer("vuelo_id");
            $table->integer("pago_id")->nullable();
            $table->boolean('estado')->default(1);
            $table->foreign('cliente_id')->references('idcliente')->on('clientes');
            $table->foreign('pago_id')->references('idpago')->on('pagos');            
            $table->foreign('vuelo_id')->references('idvuelo')->on('vuelos');            
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
        Schema::dropIfExists('reservas');
    }
}
