<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoPagoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('info_pago')->insert([
            'emailCliente' => 'mariam@gmail.com',
            'numTarjeta' => '4111111111111111',
            'caducidad' => '12/26',
            'cvv' => '123',
            'titular' => 'Cliente Ejemplo',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
