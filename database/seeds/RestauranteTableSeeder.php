<?php

use Illuminate\Database\Seeder;

class RestauranteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurantes')->insert([
            'departamendo' => 'San salvador',
            'municipio' => 'San salvador',
            'ciudad' => 'San salvador',
            'calle' => 'Calle #13',
            'estado' => 1
        ]);
    }
}
