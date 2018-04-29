<?php

use Illuminate\Database\Seeder;

class TiposPlatilloTableSeeder extends Seeder
{
    /*
     * Run the database seeds.
     *Acompañamiento.
     * @return void
    */
    public function run()
    {
        DB::table('tipos_platillo')->insert([
            'tipo_platillo' => 'Almuerzo'
        ]);

        DB::table('tipos_platillo')->insert([
            'tipo_platillo' => 'Bocadillos'
        ]);

        DB::table('tipos_platillo')->insert([
            'tipo_platillo' => 'Cena'
        ]);

        DB::table('tipos_platillo')->insert([
            'tipo_platillo' => 'Comida de Una Sola Olla'
        ]);

        DB::table('tipos_platillo')->insert([
            'tipo_platillo' => 'Desayuno'
        ]);
    }
}
