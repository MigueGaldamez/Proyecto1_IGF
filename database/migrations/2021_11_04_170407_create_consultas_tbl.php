<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEspecialista')->unsigned();
            $table->foreign('idEspecialista')->references('id')->on('especialista'); 
            $table->unsignedBigInteger('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('users'); 
            $table->string('titulo');
            $table->text('consulta');
            $table->decimal('precio',7,2)->nullable();
            $table->unsignedInteger('estado');
            $table->unsignedBigInteger('idSala')->unsigned()->nullable();
            $table->foreign('idSala')->references('id')->on('salaChat'); 
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
        Schema::dropIfExists('consultas');
    }
}
