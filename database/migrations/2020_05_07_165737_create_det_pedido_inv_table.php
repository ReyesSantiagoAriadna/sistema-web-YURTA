<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetPedidoInvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_pedido_inv', function (Blueprint $table) { 
            $table->bigIncrements('id');
            $table->string('medida');
            $table->integer('cantidad');

            $table->bigInteger('id_pedido')->unsigned()->index();
            $table->foreign('id_pedido')
                ->references('id')->on('pedidoInv')->onDelete('cascade');

            $table->bigInteger('ped_producto')->unsigned()->index();
            $table->foreign('ped_producto')
                ->references('id')->on('producto')->onDelete('cascade');
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
        Schema::dropIfExists('det_pedido_inv');
    }
}
