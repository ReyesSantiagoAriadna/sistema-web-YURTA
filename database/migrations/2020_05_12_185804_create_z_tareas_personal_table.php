<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZTareasPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_tareas_personal', function (Blueprint $table) {
            $table->bigIncrements('consecutivo'); 

            $table->bigInteger('id_tarea')->unsigned()->index();
            $table->foreign('id_tarea')
                ->references('id')->on('z_tareas')->onDelete('cascade');
           
            
            $table->bigInteger('id_personal')->unsigned()->index();
            $table->foreign('id_personal')
                ->references('id')->on('z_personals')->onDelete('cascade');
           
            $table->date('fecha');
            $table->integer('status'); 
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
        Schema::dropIfExists('z_tareas_personal');
    }
}
