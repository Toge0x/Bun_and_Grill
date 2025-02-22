<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteAlergenoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('cliente_alergenos')->insert([
            [
                'cliente_email' => 'pacop@gmail.com',
                'alergeno' => 'Gluten'
            ],
            [
                'cliente_email' => 'pacop@gmail.com',
                'alergeno' => 'Lácteos'
            ],
            [
                'cliente_email' => 'mariam@gmail.com',
                'alergeno' => 'Pescado'
            ]/*,        // no se introduce porque viola integridad referencial
            [
                'cliente_email' => 'juan@gmail.com',
                'alergeno' => 'Cacahuetes'
            ]*/
        ]);
    }
}
