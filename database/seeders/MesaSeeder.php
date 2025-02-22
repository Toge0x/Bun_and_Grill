<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesaSeeder extends Seeder
{
    public function run()
    {
        DB::table('mesas')->insert([
            [
                'mesa_id' => 1,
                'capacidad' => 4,
                'estado' => 'Disponible'
            ],
            [
                'mesa_id' => 2,
                'capacidad' => 2,
                'estado' => 'Disponible'
            ],
            [
                'mesa_id' => 3,
                'capacidad' => 6,
                'estado' => 'Disponible'
            ],
            [
                'mesa_id' => 4,
                'capacidad' => 8,
                'estado' => 'Disponible'
            ]
        ]);
    }
}
