<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['email' => 'pacop@gmail.com', 'puntos' => 100],
            ['email' => 'mariam@gmail.com', 'puntos' => 50],
            ['email' => 'luisg@gmail.com', 'puntos' => 200],
            ['email' => 'anal@gmail.com', 'puntos' => 150],
            ['email' => 'josem@gmail.com', 'puntos' => 90],
            ['email' => 'sofiat@gmail.com', 'puntos' => 120],
            ['email' => 'pedros@gmail.com', 'puntos' => 300],
            ['email' => 'laurag@gmail.com', 'puntos' => 80],
            ['email' => 'carlosr@gmail.com', 'puntos' => 110],
            ['email' => 'elenaf@gmail.com', 'puntos' => 60],
        ];

        foreach ($clientes as $data) {
            Cliente::firstOrCreate(['email' => $data['email']], $data);
        }
    }
}
