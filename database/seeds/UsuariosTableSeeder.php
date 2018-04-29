<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'root',
            'nombre' => 'admin',
            'apellido' => 'admin',
            'fecha_nacimiento' => new DateTime(),
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'estado' => true,
            'tipo_usuario_id' => 4
        ]);

        DB::table('users')->insert([
            'username' => 'persona',
            'nombre' => 'cliente',
            'apellido' => 'cliente',
            'fecha_nacimiento' => new DateTime(),
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('cliente'),
            'estado' => true,
            'tipo_usuario_id' => 1
        ]);
    }
}
