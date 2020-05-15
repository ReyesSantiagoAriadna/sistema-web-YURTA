<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZCultivoEtapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_cultivo_etapas', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('nombre'); 
            $table->integer('orden');
            $table->integer('dias'); 

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
        Schema::dropIfExists('z_cultivo_etapas');
    }
}
