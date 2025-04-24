<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('carta')->insert([
            'nombre' => 'Carta Primavera',
            'fecha' => now()->toDateString(),
            'idRestaurante' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
