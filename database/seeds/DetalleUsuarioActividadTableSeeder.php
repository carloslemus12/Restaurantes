<?php

use Illuminate\Database\Seeder;

class DetalleUsuarioActividadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalle_usuario_actividad')->insert([
            'actividad_id' => 1,
            'usuario_id' => 1,
            'created_at' => new DateTime()
        ]);
    }
}
