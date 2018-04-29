<?php

use Illuminate\Database\Seeder;

class ActividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actividades')->insert([
            'actividad' => 'primera vez'
        ]);

        DB::table('actividades')->insert([
            'actividad' => 'inicio de sesion'
        ]);

        DB::table('actividades')->insert([
            'actividad' => 'salir de la sesion'
        ]);

        DB::table('actividades')->insert([
            'actividad' => 'votar'
        ]);

        DB::table('actividades')->insert([
            'actividad' => 'comendar'
        ]);

        DB::table('actividades')->insert([
            'actividad' => 'suguerir'
        ]);
    }
}
