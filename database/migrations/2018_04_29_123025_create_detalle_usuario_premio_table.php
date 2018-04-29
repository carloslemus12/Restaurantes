<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleUsuarioPremioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_usuario_premio', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('premio_id');

            $table->unsignedInteger('usuario_id');

            $table->timestamps();

            $table->foreign('premio_id')->references('id')->on('premios');
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
        Schema::dropIfExists('detalle_usuario_premio');
    }
}
