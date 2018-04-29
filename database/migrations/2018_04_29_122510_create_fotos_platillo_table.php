<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosPlatilloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_platillo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto', 250);
            $table->unsignedInteger('platillo_id');
            $table->timestamps();

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
        Schema::dropIfExists('fotos_platillo');
    }
}
