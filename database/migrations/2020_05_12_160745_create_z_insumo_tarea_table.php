<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZInsumoTareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_insumo_tarea', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('idInsumo')->unsigned()->index();
            $table->foreign('idInsumo')
                ->references('id')->on('z_insumos')->onDelete('cascade');
             
            $table->double('cantidad', 8, 2);

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
        Schema::dropIfExists('z_insumo_tarea');
    }
}
