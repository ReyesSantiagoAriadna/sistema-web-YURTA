<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetPedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_ped', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');

            $table->bigInteger('id_pedido')->unsigned()->index();
            $table->foreign('id_pedido')
                ->references('id')->on('pedido')->onDelete('cascade');

            $table->bigInteger('ped_material')->unsigned()->index();
            $table->foreign('ped_material')
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
        Schema::dropIfExists('det_ped');
    }
}
