<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPerdidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_perdida', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('idProducto')->unsigned()->index();
            $table->foreign('idProducto')
                ->references('id')->on('z_productos')->onDelete('cascade');
             
            $table->date('fecha');
            $table->integer('cantidad');
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
        Schema::dropIfExists('z_perdida');
    }
}
