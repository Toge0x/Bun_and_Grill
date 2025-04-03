<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\LineaPedido;
use Carbon\Carbon;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            $total = 0;

            $pedido = Pedido::create([
                'cliente_email' => $cliente->email,
                'fecha' => Carbon::now()->toDateString(),
                'estado' => 'Pendiente',
                'total' => 0,
            ]);

            $productos = Producto::inRandomOrder()->take(rand(1, 3))->get();

            foreach ($productos as $producto) {
                $cantidad = rand(1, 5);
                $subtotal = $producto->precio * $cantidad;

                LineaPedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto->idProducto,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $pedido->total = $total;
            $pedido->save();
        }
    }
}
