<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TiposUsuarioTableSeeder::class,
            TiposPlatilloTableSeeder::class,
            ActividadesTableSeeder::class,
            UsuariosTableSeeder::class,
            PlatillosTableSeeder::class,
            DetalleUsuarioActividadTableSeeder::class,
            RestauranteTableSeeder::class,
            DetalleUsuarioRestauranteTableSeeder::class
        ]);
    }
}
