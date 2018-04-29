<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRestauranteVotacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_restaurante_votacion', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('restaurante_id');

            $table->unsignedInteger('usuario_id');

            $table->integer('voto');

            $table->timestamps();

            $table->foreign('restaurante_id')->references('id')->on('restaurantes');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_restaurante_votacion');
    }
}
