<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mesa;

class MesaSeeder extends Seeder
{
    public function run(): void
    {
        $mesas = [
            ['capacidad' => 2, 'estado' => 'Disponible'],
            ['capacidad' => 4, 'estado' => 'Disponible'],
            ['capacidad' => 6, 'estado' => 'Disponible'],
            ['capacidad' => 8, 'estado' => 'Disponible'],
        ];

        foreach ($mesas as $data) {
            Mesa::firstOrCreate($data);
        }
    }
}
