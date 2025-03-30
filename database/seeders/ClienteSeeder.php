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
        ];

        foreach ($clientes as $data) {
            Cliente::firstOrCreate(['email' => $data['email']], $data);
        }
    }
}
