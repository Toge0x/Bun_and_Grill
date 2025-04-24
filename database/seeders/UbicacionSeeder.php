<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ubicacion')->insert([
            'direccion' => 'Calle Bun & Grill 123',
            'codPostal' => '03001',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
