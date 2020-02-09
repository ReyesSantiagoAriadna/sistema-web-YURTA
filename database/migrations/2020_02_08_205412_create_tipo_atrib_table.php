<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoAtribTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_atrib', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');

            $table->bigInteger('tipo_atrib_f')->unsigned()->index();
            $table->foreign('tipo_atrib_f')
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
        Schema::dropIfExists('tipo_atrib');
    }
}
