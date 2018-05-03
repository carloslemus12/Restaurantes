<?php

use Illuminate\Database\Seeder;

class TipoPremioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_premios')->insert([
            'tipo' => 'Creacion de cuenta'
        ]);

        DB::table('tipos_premios')->insert([
            'tipo' => 'Comentarios frecuentes'
        ]);

        DB::table('tipos_premios')->insert([
            'tipo' => 'Recomendaciones frecuentes'
        ]);

        DB::table('tipos_premios')->insert([
            'tipo' => 'Votaciones frecuentes'
        ]);

        DB::table('tipos_premios')->insert([
            'tipo' => 'Participacion frecuente'
        ]);
    }
}
