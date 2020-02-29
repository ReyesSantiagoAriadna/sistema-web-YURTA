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
    public function up(){
        Schema::create('material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->bigInteger('unidad')->unsigned()->index();
            $table->bigInteger('tipo')->unsigned()->index();
            $table->string('marca');
            $table->integer('existencias');
            $table->integer('cantidad_minima')->default('3')->nullable();
            $table->double('precio_unitario', 8, 2);
            $table->bigInteger('proveedor')->unsigned()->index();
            $table->string('url_imagen')->nullable();
            $table->timestamps();
            $table->foreign('proveedor')
                ->references('id')->on('proveedor')->onDelete('cascade');
            $table->foreign('tipo')
                ->references('id')->on('tipo_material')->onDelete('cascade');
            $table->foreign('unidad')
                ->references('id')->on('unidad_material')->onDelete('cascade');
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
