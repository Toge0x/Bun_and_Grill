<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Mesa;
use Carbon\Carbon;

class ReservaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::inRandomOrder()->take(10)->get();
        $mesas = Mesa::where('capacidad', '>=', 2)->get();

        if ($clientes->isEmpty() || $mesas->isEmpty()) {
            echo "No se pudieron crear reservas: faltan clientes o mesas.\n";
            return;
        }

        foreach ($clientes as $cliente) {
            $mesa = $mesas->random();
            Reserva::create([
                'cliente_email' => $cliente->email,
                'mesa_id' => $mesa->mesa_id,
                'fechaReserva' => Carbon::now()->addDays(rand(1, 30))->toDateString(),
                'horaReserva' => Carbon::now()->addHours(rand(12, 21))->toTimeString(),
                'duracion' => rand(30, 120),
                'estado' => 'Reservada',
            ]);
        }
    }
}
