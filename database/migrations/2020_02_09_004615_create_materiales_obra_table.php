<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialesObraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiales_obra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->integer('cantidad_minima')->default('3');
            $table->bigInteger('id_obra')->unsigned()->index();
            $table->foreign('id_obra')
                ->references('id')->on('obra')->onDelete('cascade');

            $table->bigInteger('mat_obra')->unsigned()->index();
            $table->foreign('mat_obra')
                ->references('id')->on('material')->onDelete('cascade');

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
        Schema::dropIfExists('materiales_obra');
    }
}
