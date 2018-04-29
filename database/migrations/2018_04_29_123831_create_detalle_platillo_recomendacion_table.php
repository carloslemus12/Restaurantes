<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePlatilloRecomendacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_platillo_recomendacion', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('usuario_id');

            $table->unsignedInteger('platillo_id');

            $table->string('recomendacion', 400);

            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('platillo_id')->references('id')->on('platillos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_platillo_recomendacion');
    }
}
