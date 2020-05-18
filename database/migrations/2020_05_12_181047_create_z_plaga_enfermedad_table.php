<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPlagaEnfermedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_plaga_enfermedad', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            
            $table->bigInteger('id_Cultivo')->unsigned()->index();
            $table->foreign('id_Cultivo')
                ->references('id')->on('z_cultivo')->onDelete('cascade');
             
            $table->string('nombre');
            $table->date('fecha');
            $table->string('observacion');
            $table->string('tratamiento'); 
            
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
        Schema::dropIfExists('z_plaga_enfermedad');
    }
}
