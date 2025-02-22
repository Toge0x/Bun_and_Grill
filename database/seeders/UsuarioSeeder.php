<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'paco',
                'apellidos' => 'perez',
                'email' => 'pacop@gmail.com',
                'password' => Hash::make('pacop89'),
                'telefono' => '123456789',
                'direccion' => 'calle ua',
                'sexo' => 'Masculino'
            ],
            [
                'nombre' => 'maria',
                'apellidos' => 'marcos',
                'email' => 'mariam@gmail.com',
                'password' => Hash::make('mariam04'),
                'telefono' => '987654321',
                'direccion' => 'calle au',
                'sexo' => 'Femenino'
            ]
        ]);
    }
}
