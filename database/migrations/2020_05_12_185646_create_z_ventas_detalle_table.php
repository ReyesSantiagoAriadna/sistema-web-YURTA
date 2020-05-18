<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZVentasDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_ventas_detalle', function (Blueprint $table) {
            $table->bigIncrements('id');           
            
            $table->bigInteger('codigoProducto')->unsigned()->index();
            $table->foreign('codigoProducto')
                ->references('id')->on('z_productos')->onDelete('cascade');
            
            $table->string('nombre');
            $table->string('unidadM');
            $table->double('precioU', 8, 2);
            $table->double('cantidad', 8, 2); 
            $table->double('subtotal', 8, 2); 

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
        Schema::dropIfExists('z_ventas_detalle');
    }
}
