<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Mesa;
use App\Models\Reserva;

class ReservaTest extends TestCase
{
    use RefreshDatabase;

    public function test_cliente_tiene_reserva(): void
    {
        // Arrange: crear usuario, cliente, mesa y reserva
        $usuario = Usuario::factory()->create(['email' => 'pacop@gmail.com']);
        $cliente = Cliente::factory()->create(['email' => $usuario->email]);
        $mesa = Mesa::factory()->create(['capacidad' => 4]);

        $reserva = Reserva::create([
            'cliente_email' => $cliente->email,
            'mesa_id' => $mesa->mesa_id,
            'fechaReserva' => now()->toDateString(),
            'horaReserva' => now()->toTimeString(),
            'duracion' => 1.5,
            'estado' => 'Reservada'
        ]);

        // Act: obtener las reservas del cliente
        $reservas = $cliente->reservas;

        // Assert
        $this->assertNotNull($cliente, "Cliente no encontrado");
        $this->assertNotNull($mesa, "Mesa no encontrada");
        $this->assertTrue($reservas->contains($reserva), "La reserva no está asociada al cliente");
    }
}
