<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_tareas', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('id_fkcultivo')->unsigned()->index();
            $table->foreign('id_fkcultivo')
                ->references('id')->on('z_cultivo')->onDelete('cascade');
            
            $table->string('nombre');
            $table->string('etapa');
            $table->string('tipo'); 
            $table->time('horaInicio');
            $table->time('horaFinal');
            $table->string('detalle');
            $table->string('backgroundColor');
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
        Schema::dropIfExists('z_tareas');
    }
}
