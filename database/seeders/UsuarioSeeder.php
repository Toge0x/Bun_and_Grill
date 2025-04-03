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
            ['nombre' => 'paco', 'apellidos' => 'perez', 'email' => 'pacop@gmail.com', 'password' => Hash::make('pacop89'), 'telefono' => '123456789', 'direccion' => 'calle ua', 'sexo' => 'Masculino'],
            ['nombre' => 'maria', 'apellidos' => 'marcos', 'email' => 'mariam@gmail.com', 'password' => Hash::make('mariam04'), 'telefono' => '987654321', 'direccion' => 'calle au', 'sexo' => 'Femenino'],
            ['nombre' => 'luis', 'apellidos' => 'gomez', 'email' => 'luisg@gmail.com', 'password' => Hash::make('luisg12'), 'telefono' => '111222333', 'direccion' => 'avenida central', 'sexo' => 'Masculino'],
            ['nombre' => 'ana', 'apellidos' => 'lopez', 'email' => 'anal@gmail.com', 'password' => Hash::make('ana123'), 'telefono' => '444555666', 'direccion' => 'calle sur', 'sexo' => 'Femenino'],
            ['nombre' => 'jose', 'apellidos' => 'martinez', 'email' => 'josem@gmail.com', 'password' => Hash::make('jose789'), 'telefono' => '777888999', 'direccion' => 'barrio norte', 'sexo' => 'Masculino'],
            ['nombre' => 'sofia', 'apellidos' => 'torres', 'email' => 'sofiat@gmail.com', 'password' => Hash::make('sofia456'), 'telefono' => '123123123', 'direccion' => 'calle oeste', 'sexo' => 'Femenino'],
            ['nombre' => 'pedro', 'apellidos' => 'sanchez', 'email' => 'pedros@gmail.com', 'password' => Hash::make('pedro321'), 'telefono' => '321321321', 'direccion' => 'avenida 5', 'sexo' => 'Masculino'],
            ['nombre' => 'laura', 'apellidos' => 'gonzalez', 'email' => 'laurag@gmail.com', 'password' => Hash::make('laura654'), 'telefono' => '654654654', 'direccion' => 'plaza mayor', 'sexo' => 'Femenino'],
            ['nombre' => 'carlos', 'apellidos' => 'rodriguez', 'email' => 'carlosr@gmail.com', 'password' => Hash::make('carlos987'), 'telefono' => '987987987', 'direccion' => 'zona industrial', 'sexo' => 'Masculino'],
            ['nombre' => 'elena', 'apellidos' => 'fernandez', 'email' => 'elenaf@gmail.com', 'password' => Hash::make('elena369'), 'telefono' => '369369369', 'direccion' => 'urbanización del este', 'sexo' => 'Femenino'],
        ];

        foreach ($usuarios as $data) {
            Usuario::firstOrCreate([
                'email' => $data['email']
            ], $data);
        }
    }
}
