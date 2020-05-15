<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZSolarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_solar', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('nombre');
            $table->double('largo', 8, 2);
            $table->double('ancho', 8, 2);
            $table->string('region');
            $table->string('distrito');
            $table->string('municipio');
            $table->double('latitud', 20, 10);
            $table->double('longitud', 20, 10);
            $table->string('descripcion'); 
            $table->double('costoHora', 8, 2);

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
        Schema::dropIfExists('z_solar');
    }
}
