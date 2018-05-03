<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('premio', 150)->unique();
            $table->integer('dia');
            $table->integer('mes');
            $table->integer('anio');
            $table->string('descripcion', 250);
            $table->unsignedInteger('tipo_premio_id');
            $table->timestamps();

            $table->foreign('tipo_premio_id')->references('id')->on('tipos_premios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('premios');
    }
}
