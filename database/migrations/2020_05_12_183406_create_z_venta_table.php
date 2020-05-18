<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_venta', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('idPersonal')->unsigned()->index();
            $table->foreign('idPersonal')
                ->references('id')->on('z_personals')->onDelete('cascade');
             
            $table->bigInteger('idCliente')->unsigned()->index();
            $table->foreign('idCliente')
                 ->references('id')->on('z_clientes')->onDelete('cascade');
                 
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
        Schema::dropIfExists('z_venta');
    }
}
