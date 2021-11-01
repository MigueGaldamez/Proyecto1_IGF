<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialista', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('users'); 
            $table->unsignedBigInteger('idEspecialidad')->unsigned();
            $table->foreign('idEspecialidad')->references('id')->on('especialidad'); 
            $table->string('reconocimiento');
            $table->string('tituloGraduado');
            $table->date('fechaInicio');
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
        Schema::dropIfExists('especialista');
    }
}
