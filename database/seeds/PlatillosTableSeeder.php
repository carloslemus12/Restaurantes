<?php

use Illuminate\Database\Seeder;

class PlatillosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('platillos')->insert([
            'platillo' => 'Pollo frito',
            'descripcion' => 'Un pollo muerto frito',
            'estado' => 1,
            'especialidad' => 0,
            'precio' => 4.50,
            'tipo_id' => 1
        ]);
    }
}
