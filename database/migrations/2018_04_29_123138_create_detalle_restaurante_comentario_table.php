<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRestauranteComentarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_restaurante_comentario', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('restaurante_id');
            $table->unsignedInteger('usuario_id');

            $table->string('comentario', 250);

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
        Schema::dropIfExists('detalle_restaurante_comentario');
    }
}
