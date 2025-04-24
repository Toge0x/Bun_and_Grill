<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministradorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('administrador')->insert([
            'emailUsuario' => 'pacop@gmail.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
