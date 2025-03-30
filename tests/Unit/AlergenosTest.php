<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Alergeno;

class AlergenosTest extends TestCase
{
    use RefreshDatabase;

    public function test_cliente_tiene_alergeno(): void
    {
        // Arrange: crear usuario y cliente
        $usuario = Usuario::factory()->create(['email' => 'pacop@gmail.com']);
        $cliente = Cliente::factory()->create(['email' => $usuario->email]);

        // Crear alérgeno
        $alergeno = Alergeno::factory()->create(['nombre' => 'Gluten']);

        // Asociar alérgeno al cliente
        $cliente->alergenos()->attach($alergeno->id);

        // Act: recuperar los alérgenos del cliente
        $alergenosCliente = $cliente->alergenos;

        // Assert
        $this->assertNotNull($cliente, "Cliente no encontrado");
        $this->assertTrue(
            $alergenosCliente->contains('nombre', 'Gluten'),
            "Alergeno 'Gluten' no asociado al cliente"
        );
    }
}
