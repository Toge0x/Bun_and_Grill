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
        $cliente = Cliente::where('email', 'pacop@gmail.com')->first();     // asegurarse de que existen el cliente y la mesa
        $mesa = Mesa::where('capacidad', '>=', 4)->first();         // primera mesa con capacidad >= 4

        if($cliente && $mesa){
            Reserva::create([
                'cliente_email' => $cliente->email,
                'mesa_id' => $mesa->mesa_id,
                'fechaReserva' => Carbon::now()->toDateString(),
                'horaReserva' => Carbon::now()->toTimeString(),
                'duracion' => 30,
                'estado' => 'Reservada'
            ]);
        }else{
            echo "No se pudo crear la reserva: cliente o mesa no encontrada.\n";
        }
    }
}
