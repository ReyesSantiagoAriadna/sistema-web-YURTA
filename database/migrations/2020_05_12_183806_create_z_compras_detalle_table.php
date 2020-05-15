<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZComprasDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_compras_detalle', function (Blueprint $table) {
             
            $table->bigInteger('id_compra')->unsigned()->index();
            $table->foreign('id_compra')
                ->references('id')->on('z_compras')->onDelete('cascade');
             

            $table->bigInteger('id_insumo')->unsigned()->index();
            $table->foreign('id_insumo')
                ->references('id')->on('z_insumos')->onDelete('cascade');
             
            $table->integer('cantidad');
            $table->double('precio', 8, 2);  
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
        Schema::dropIfExists('z_compras_detalle');
    }
}
