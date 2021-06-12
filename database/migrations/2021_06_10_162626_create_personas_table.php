<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

      //  DB::table('personas')->insert(array('pnombre'=>'Zuley','snombre'=>'Lorens','papellido'=>'Reyes','sapellido'=>'Hernandez',
        //'dui'=>'11111111-1','nit'=>'2222-222222-222-2','pasaporte'=>'123456','fechanaci'=>'2000-1-1','direccion'=>'San Salvador','telefono'=>'2210-1220','movil'=>'7123-4567'));
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
