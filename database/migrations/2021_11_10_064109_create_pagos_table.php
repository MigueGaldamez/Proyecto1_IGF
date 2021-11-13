<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idConsulta')->unsigned();
            $table->foreign('idConsulta')->references('id')->on('consultas'); 
            $table->unsignedBigInteger('idTarjeta')->unsigned();
            $table->foreign('idTarjeta')->references('id')->on('tarjeta'); 
            $table->unsignedBigInteger('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('users'); 
            $table->unsignedBigInteger('idEspecialista')->unsigned();
            $table->foreign('idEspecialista')->references('id')->on('users'); 
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
        Schema::dropIfExists('pagos');
    }
}
