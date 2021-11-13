<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajeChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajeChat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idSalaChat')->unsigned();
            $table->foreign('idSalaChat')->references('id')->on('salaChat');
            $table->unsignedBigInteger('idUsuario')->unsigned()->nullable();
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->mediumText('mensaje');
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
        Schema::dropIfExists('mensajeChat');
    }
}
