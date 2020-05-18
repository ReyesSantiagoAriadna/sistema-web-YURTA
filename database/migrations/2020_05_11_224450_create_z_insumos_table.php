<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_insumos', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('nombre');
            $table->string('tipo');
            $table->string('unidadM');
            $table->string('especie');
            $table->double('tamano', 8, 2);
            $table->string('composicion');            
            $table->double('cantidad', 8, 2);
            $table->double('cantidadMinima', 8, 2);
            $table->string('observacion');

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
        Schema::dropIfExists('z_insumos');
    }
}
