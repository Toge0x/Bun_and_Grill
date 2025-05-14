<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cliente;
use App\Models\Usuario;

class UsuarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_cliente_crud(): void
    {
        // Arrange: crea usuario y cliente relacionados
        $usuario = Usuario::factory()->create([
            'email' => 'mariam@gmail.com'
        ]);

        Cliente::factory()->create([
            'email' => $usuario->email,
            'puntos' => 50
        ]);

        // Act: obtener cliente y su usuario relacionado
        $cliente = Cliente::where('email', 'mariam@gmail.com')->first();
        $usuarioRelacionado = $cliente->usuario;

        // Assert: ambos deben existir
        $this->assertNotNull($cliente, "Cliente no encontrado");
        $this->assertNotNull($usuarioRelacionado, "Usuario relacionado no encontrado");
        $this->assertEquals('mariam@gmail.com', $usuarioRelacionado->email);
    }
}
