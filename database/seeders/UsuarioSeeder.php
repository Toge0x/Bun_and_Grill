<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'nombre' => 'paco',
                'apellidos' => 'perez',
                'email' => 'pacop@gmail.com',
                'password' => Hash::make('pacop89'),
                'telefono' => '123456789',
                'direccion' => 'calle ua',
                'sexo' => 'Masculino',
            ],
            [
                'nombre' => 'maria',
                'apellidos' => 'marcos',
                'email' => 'mariam@gmail.com',
                'password' => Hash::make('mariam04'),
                'telefono' => '987654321',
                'direccion' => 'calle au',
                'sexo' => 'Femenino',
            ]
        ];

        foreach($usuarios as $data){
            Usuario::firstOrCreate([
                'email' => $data['email']
            ], $data);
        }
    }
}
