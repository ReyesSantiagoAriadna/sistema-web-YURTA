<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_productos', function (Blueprint $table) {
            $table->bigIncrements('id'); 

            $table->bigInteger('idCultivo')->unsigned()->index();
            $table->foreign('idCultivo')
                ->references('id')->on('z_cultivo')->onDelete('cascade');

            $table->string('nombre');
            $table->integer('equiKilos');
            $table->double('precioMay', 8, 2);
            $table->double('precioMen', 8, 2);
            $table->double('cantExis', 8, 2);
            $table->integer('semana');
            $table->string('url_imagen');
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
        Schema::dropIfExists('z_productos');
    }
}
