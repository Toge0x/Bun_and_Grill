<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservas')->insert([
            [
                'reserva_id' => 1,
                'cliente_email' => 'pacop@gmail.com',
                'mesa_id' => 1,
                'fechaReserva' => Carbon::now()->format('Y-m-d'),
                'horaReserva' => Carbon::now()->format('H:i:s'),
                'duracion' => 30,
                'estado' => 'Reservada'
            ]
        ]);
    }
}
