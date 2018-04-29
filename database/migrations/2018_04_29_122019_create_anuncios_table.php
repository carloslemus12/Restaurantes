<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anuncio', 300);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->unsignedInteger('restaurante_id');
            $table->unsignedInteger('usuario_id');
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
        Schema::dropIfExists('anuncios');
    }
}
