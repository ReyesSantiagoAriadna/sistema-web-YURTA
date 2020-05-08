<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoInvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidoInv', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->date('fecha_pedido');
            $table->date('fecha_entrega');
            $table->string('estado')->default('0');  
            
            $table->bigInteger('cliente')->unsigned()->index();   
            $table->foreign('cliente')
            ->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('predido');
    }
}
