<?php

use Illuminate\Database\Seeder;

class DetalleUsuarioRestauranteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalle_usuario_restaurante')->insert([
            'restaurante_id' => 1,
            'usuario_id' => 2,
            'created_at' => new DateTime()
        ]);
    }
}
