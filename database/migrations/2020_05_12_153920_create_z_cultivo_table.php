<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZCultivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_cultivo', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('id_fksolar')->unsigned()->index();
            $table->foreign('id_fksolar')
                ->references('id')->on('z_solar')->onDelete('cascade');
            
            $table->string('tipo');
            $table->string('nombre');
            $table->double('largo', 8, 2);
            $table->integer('ancho');
            $table->date('fecha');
            $table->date('fechaFinal');
            $table->integer('moniSensor');
            $table->string('observacion');
            $table->integer('tempMin');
            $table->integer('tempMax');
            $table->integer('humeMin');
            $table->integer('humeMax');
            $table->integer('humeSMin');
            $table->integer('humeSMax');
            
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
        Schema::dropIfExists('z_cultivo');
    }
}
