<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurante;

class RestauranteSeeder extends Seeder
{
    public function run(): void
    {
        Restaurante::create([
            'cif' => 'B12345678',
            'telfs' => ['965000001', '965000002'],
            'descripcion' => 'Restaurante de hamburguesas gourmet',
            'email' => 'contacto@bungrill.com',
            'idUbicacion' => 1
        ]);
    }
}

