<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuarioTest extends TestCase
{

    public function test_Cliente_Tiene_Usuario(): void
    {

        $cliente = DB::table('clientes')->where('email', 'mariam@gmail.com')->first();

        $this->assertNotNull($cliente, "Cliente no encontrado");


        $alergeno = DB::table('usuarios')
            ->where('email', $cliente->email)
            ->first();


        $this->assertNotNull($alergeno, "Alergeno 'gluten' no encontrado");

    }
}