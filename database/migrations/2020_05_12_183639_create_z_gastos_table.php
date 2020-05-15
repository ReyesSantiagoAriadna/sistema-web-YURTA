<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_gastos', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('id_fkcultivo')->unsigned()->index();
            $table->foreign('id_fkcultivo')
                ->references('id')->on('z_cultivo')->onDelete('cascade');
            
            $table->date('fecha');
            $table->double('costo', 8, 2);
            $table->string('descripcion');
            
            $table->bigInteger('id_herramienta')->unsigned()->index();
            $table->foreign('id_herramienta')
                ->references('id')->on('z_herramienta')->onDelete('cascade');
            
            $table->bigInteger('id_personal')->unsigned()->index();
            $table->foreign('id_personal')
                ->references('id')->on('z_personals')->onDelete('cascade');

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
        Schema::dropIfExists('z_gastos');
    }
}
