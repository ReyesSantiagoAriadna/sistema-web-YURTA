<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_pedido', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('id_cliente')->unsigned()->index();
            $table->foreign('id_cliente')
                ->references('id')->on('z_clientes')->onDelete('cascade');
             
            $table->date('fechaSolicitud');
            $table->date('fechaSurtido');
            $table->string('estatus');
            $table->double('total', 8, 2); 

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
        Schema::dropIfExists('z_pedido');
    }
}
