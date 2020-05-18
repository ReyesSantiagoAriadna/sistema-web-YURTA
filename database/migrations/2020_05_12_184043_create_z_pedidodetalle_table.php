<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPedidodetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_pedidodetalle', function (Blueprint $table) {
            
            $table->bigInteger('idPedido')->unsigned()->index();
            $table->foreign('idPedido')
                ->references('id')->on('z_pedido')->onDelete('cascade');
                           
            $table->string('nombreProducto');
            $table->integer('cantidad');
            
            $table->bigInteger('idProducto')->unsigned()->index();
            $table->foreign('idProducto')
                ->references('id')->on('z_productos')->onDelete('cascade');
               
            $table->string('unidadM');
            $table->double('precioUnitario', 8, 2);
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
        Schema::dropIfExists('z_pedidodetalle');
    }
}
