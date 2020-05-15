<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZAlmacensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_almacens', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('nombre');
            $table->string('region');
            $table->string('distrito');
            $table->string('municipio');  
            $table->double('latitud', 20, 10);
            $table->double('longitud', 20, 10);
            $table->string('descripcion');
            
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
        Schema::dropIfExists('z_almacens');
    }
}
