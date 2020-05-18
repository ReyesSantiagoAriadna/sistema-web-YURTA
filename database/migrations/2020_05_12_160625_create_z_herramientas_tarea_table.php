<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZHerramientasTareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_herramientas_tarea', function (Blueprint $table) {
            $table->bigIncrements('id'); 

            $table->bigInteger('idHerramienta')->unsigned()->index();
            $table->foreign('idHerramienta')
                ->references('id')->on('z_herramienta')->onDelete('cascade');

            $table->integer('status');
            $table->integer('cantidad');
             
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
        Schema::dropIfExists('z_herramientas_tarea');
    }
}
