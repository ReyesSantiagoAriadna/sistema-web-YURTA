<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZComunidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_comunidades', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('region');
            $table->string('distrito');
            $table->string('numero_municipio');
            $table->string('municipio');
            $table->double('latitud', 20, 10);
            $table->double('longitud', 20, 10);

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
        Schema::dropIfExists('z_comunidades');
    }
}
