<?php

namespace App\Http\Controllers;

use App\Models\LineaPedido;
use Illuminate\Http\Request;

class LineaPedidoController extends Controller
{
    public function index()
    {
        $lineasPedido = LineaPedido::orderBy('id', 'desc')->paginate(10);
        return view('lineapedidos.index', compact('lineasPedido'));
    }

    public function create()
    {
        return view('lineapedidos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id'   => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        LineaPedido::create([
            'pedido_id'   => $request->pedido_id,
            'producto_id' => $request->producto_id,
            'cantidad'    => $request->cantidad,
        ]);

        return redirect()->route('lineapedidos.index')
                         ->with('success', 'Línea de pedido creada correctamente.');
    }

    public function show($id)
    {
        $lineaPedido = LineaPedido::findOrFail($id);
        return view('lineapedidos.show', compact('lineaPedido'));
    }

    public function edit($id)
    {
        $lineaPedido = LineaPedido::findOrFail($id);
        return view('lineapedidos.edit', compact('lineaPedido'));
    }

    public function update(Request $request, $id)
    {
        $lineaPedido = LineaPedido::findOrFail($id);

        $request->validate([
            'pedido_id'   => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $lineaPedido->update([
            'pedido_id'   => $request->pedido_id,
            'producto_id' => $request->producto_id,
            'cantidad'    => $request->cantidad,
        ]);

        return redirect()->route('lineapedidos.index')
                         ->with('success', 'Línea de pedido actualizada correctamente.');
    }

    public function destroy($id)
    {
        $lineaPedido = LineaPedido::findOrFail($id);
        $lineaPedido->delete();

        return redirect()->route('lineapedidos.index')
                         ->with('success', 'Línea de pedido eliminada correctamente.');
    }
}
