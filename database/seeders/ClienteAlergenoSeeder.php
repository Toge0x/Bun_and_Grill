<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Alergeno;

class ClienteAlergenoSeeder extends Seeder
{
    public function run(): void
    {
        $asignaciones = [
            'pacop@gmail.com' => ['Gluten', 'Lácteos'],
            'mariam@gmail.com' => ['Pescado'],
        ];

        foreach ($asignaciones as $email => $alergenos) {
            $cliente = Cliente::where('email', $email)->first();

            if ($cliente) {
                foreach ($alergenos as $nombre) {
                    $alergeno = Alergeno::firstOrCreate(['nombre' => $nombre]);
                    $cliente->alergenos()->syncWithoutDetaching($alergeno->id);
                }
            }
        }
    }
}
