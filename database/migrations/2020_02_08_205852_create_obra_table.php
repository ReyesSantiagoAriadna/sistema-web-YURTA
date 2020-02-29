<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->double('lat', 20, 10);
            $table->double('lng', 20, 10);
            $table->date('fech_ini');
            $table->date('fech_fin');
            $table->string('dependencia');

            $table->bigInteger('encargado')->unsigned()->index();
            $table->foreign('encargado')
                ->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('tipo_obra')->unsigned()->index();
            $table->foreign('tipo_obra')
                ->references('id')->on('tipo')->onDelete('cascade');

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
        Schema::dropIfExists('obra');
    }
}
