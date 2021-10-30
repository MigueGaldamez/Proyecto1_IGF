<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarjetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjeta', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('pin');
            $table->string('banco');
            $table->date('fechaVencimiento');
            $table->integer('estado');
            $table->integer('tipo');   
            $table->unsignedBigInteger('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('users');         
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
        Schema::dropIfExists('tarjeta');
    }
}
