<?php

use Illuminate\Database\Seeder;

class TiposUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_usuario')->insert([
            'tipo' => 'cliente'
        ]);

        DB::table('tipos_usuario')->insert([
            'tipo' => 'empleado'
        ]);

        DB::table('tipos_usuario')->insert([
            'tipo' => 'moderador'
        ]);

        DB::table('tipos_usuario')->insert([
            'tipo' => 'administrador'
        ]);
    }
}
