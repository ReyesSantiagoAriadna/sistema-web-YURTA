<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_personals', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('nombre');
            $table->string('ap');
            $table->string('am');
            $table->string('direccion');
            $table->string('telefono') ;
            $table->string('celular');
            $table->string('rfc');
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
        Schema::dropIfExists('z_personals');
    }
}
