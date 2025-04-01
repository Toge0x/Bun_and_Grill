<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        // Cargar los pedidos con su cliente
        $pedidos = Pedido::with('cliente')->orderBy('fecha', 'desc')->paginate(10);
        return view('pedidos', compact('pedidos'));
    }

    public function create()
    {
        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'cliente_email' => 'required|exists:clientes,email', // Cliente debe existir
            'fecha'         => 'required|date',
            'estado'        => 'required|string',
            'total'         => 'required|numeric|min:0'
        ]);
        Pedido::create($request->all());
        return redirect()->route('pedidos')
                         ->with('success', 'Pedido creado correctamente.');
    }

    public function show($id)
    {
        $pedido = Pedido::with('cliente')->findOrFail($id);
        return view('pedidos', compact('pedido'));
    }

    public function showAll()
    {
        $pedido = Pedido::with('cliente')->all();
        return view('pedidos', compact('pedido'));
    }

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $request->validate([
            'cliente_email' => 'required|exists:clientes,email',
            'fecha'         => 'required|date',
            'estado'        => 'required|string',
            'total'         => 'required|numeric|min:0'
        ]);

        $pedido->update($request->all());

        return redirect()->route('pedidos')
                         ->with('success', 'Pedido actualizado correctamente.');
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();
        return redirect()->route('pedidos')
                         ->with('success', 'Pedido eliminado correctamente.');
    }
}

