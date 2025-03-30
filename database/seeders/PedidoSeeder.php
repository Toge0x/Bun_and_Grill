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
        $total = 0;     // para visualizar el total en el pedido no en las lineas de pedido (nuevo en UML)

        $cliente = Cliente::where('email', 'pacop@gmail.com')->first();     // consulta del cliente
        if (!$cliente) {
            return;
        }

        $pedido = Pedido::create([                          // crear el pedido
            'cliente_email' => $cliente->email,
            'fecha' => Carbon::now()->toDateString(),
            'estado' => 'Pendiente',
            'total' => 0,
        ]);
        
        $clasica = Producto::where('nombre', 'Clásica')->first();
        $quesada = Producto::where('nombre', 'Quesada')->first();

        if($clasica){                               // crear las lineas de pedido
            $linea = LineaPedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $clasica->idProducto,
                'cantidad' => 2,
                'subtotal' => $clasica->precio * 2,
            ]);
            $total += $linea->subtotal;
        }
        
        if ($quesada) {
            $linea = LineaPedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $quesada->idProducto,
                'cantidad' => 1,
                'subtotal' => $quesada->precio * 1,
            ]);
            $total += $linea->subtotal;
        }
        
        $pedido->total = $total;
        $pedido->save();
    }
}
