<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('clientes')->insert([
            [
                'email' => 'pacop@gmail.com',
                'puntos' => 100
            ],
            [
                'email' => 'mariam@gmail.com',
                'puntos' => 50
            ],/*        // este usuario no se introduce porque viola integridad referencial
            [
                'email' => 'juan@gmail.com',
                'puntos' => 20
            ]*/
        ]);
    }
}
