<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_pagos', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('idPersonal')->unsigned()->index();
            $table->foreign('idPersonal')
                ->references('id')->on('z_personals')->onDelete('cascade');
               
            $table->integer('semana');
            $table->integer('year');
            $table->double('totalPagado', 8, 2);
            $table->integer('minutosTrabajados'); 

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
        Schema::dropIfExists('z_pagos');
    }
}
