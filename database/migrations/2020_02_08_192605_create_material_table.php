<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->string('unidad');
            $table->string('tipo');
            $table->string('marca');
            $table->integer('existencias');
            $table->double('precio_unitario', 8, 2);
            $table->bigInteger('proveedor')->unsigned()->index();
            $table->timestamps();


            $table->foreign('proveedor')
                ->references('id')->on('proveedor')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material');
    }
}
