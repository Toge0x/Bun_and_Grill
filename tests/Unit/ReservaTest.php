<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservaTest extends TestCase
{

    public function test_Cliente_Tiene_Reserva(): void
    {

        $cliente = DB::table('clientes')->where('email', 'pacop@gmail.com')->first();

        $this->assertNotNull($cliente, "Cliente no encontrado");

        $mesas = DB::table('mesas')->where('mesa_id', '1')->first();
    
        $this->assertNotNull($mesas, "Mesa no encontrado");

        $alergeno = DB::table('reservas')
            ->where('mesa_id',$mesas->mesa_id)
            ->where('cliente_email', $cliente->email)  
            ->first();

        $this->assertNotNull($alergeno, "Alergeno 'gluten' no encontrado");

    }
}