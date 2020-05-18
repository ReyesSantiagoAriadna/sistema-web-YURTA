<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_compras', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('id_proveedor')->unsigned()->index();
            $table->foreign('id_proveedor')
                ->references('id')->on('z_proveedors')->onDelete('cascade');
            
            $table->date('fecha');
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
        Schema::dropIfExists('z_compras');
    }
}
