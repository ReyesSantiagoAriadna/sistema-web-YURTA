<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZDatosInvernaderoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_datos_invernadero', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('id_Cultivo')->unsigned()->index();
            $table->foreign('id_Cultivo')
                ->references('id')->on('z_cultivo')->onDelete('cascade');
             
            $table->double('temperatura', 8, 2);  
            $table->double('humedad', 8, 2);
            $table->double('suelo', 8, 2);
            $table->integer('id_sensor');

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
        Schema::dropIfExists('z_datos_invernadero');
    }
}
