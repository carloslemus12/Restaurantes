<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatillosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platillos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('platillo', 150)->unique();
            $table->string('descripcion', 250);
            $table->boolean('especialidad');
            $table->boolean('estado');
            $table->double('precio', 8, 2);
            $table->unsignedInteger('tipo_id');
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipos_platillo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platillos');
    }
}
