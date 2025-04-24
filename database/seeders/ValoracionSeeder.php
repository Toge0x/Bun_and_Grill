<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValoracionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('valoracion')->insert([
            'comentario' => '¡Todo riquísimo!',
            'valor' => 5,
            'fecha' => now()->toDateString(),
            'emailCliente' => 'pacop@gmail.com',
            'idRestaurante' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
