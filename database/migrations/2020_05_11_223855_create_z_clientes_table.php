<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_clientes', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('nombre');
            $table->string('ap');
            $table->string('am');
            $table->string('direccion');
            $table->string('telefono') ;
            $table->string('celular');
            $table->string('rfc');

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
        Schema::dropIfExists('z_clientes');
    }
}
