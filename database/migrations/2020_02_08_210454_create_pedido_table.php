<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('pedido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_p');
            $table->date('fecha_conf');
            $table->string('estado')->default('0');
            $table->bigInteger('obra')->unsigned()->index();
            $table->foreign('obra')
                ->references('id')->on('obra')->onDelete('cascade');
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
        Schema::dropIfExists('pedido');
    }
}
