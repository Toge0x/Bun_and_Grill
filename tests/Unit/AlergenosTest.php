<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlergenosTest extends TestCase
{

    public function test_Cliente_Tiene_Alergeno(): void
    {

        $cliente = DB::table('clientes')->where('email', 'pacop@gmail.com')->first();

        $this->assertNotNull($cliente, "Cliente no encontrado");

        $alergeno = DB::table('cliente_alergenos')
            ->where('alergeno', 'gluten')
            ->where('cliente_email', $cliente->email)  
            ->first();

        $this->assertNotNull($alergeno, "Alergeno 'gluten' no encontrado");

    }
}