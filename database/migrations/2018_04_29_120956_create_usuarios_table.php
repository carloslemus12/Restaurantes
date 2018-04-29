<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 150)->unique();
            $table->string('nombre', 150);
            $table->string('apellido', 150);
            $table->date('fecha_nacimiento');
            $table->string('email', 128)->unique();
            $table->string('password', 150);
            $table->boolean('estado');
            $table->integer("tipo_usuario_id")->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("tipo_usuario_id")->references('id')->on('tipos_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
