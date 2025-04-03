<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::query(); // Ajusta esto al nombre de tu modelo si es diferente

        // Búsqueda
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('cliente_email', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
                // Añade más campos de búsqueda si es necesario
            });
        }

        // Filtro por estado
        if ($request->has('estado') && $request->input('estado') != '') {
            $query->where('estado', $request->input('estado'));
        }

        // Filtro por fecha
        if ($request->has('fecha') && $request->input('fecha') != '') {
            $fecha = $request->input('fecha');

            switch ($fecha) {
                case 'hoy':
                    $query->whereDate('fecha', now()->toDateString());
                    break;
                case 'ayer':
                    $query->whereDate('fecha', now()->subDay()->toDateString());
                    break;
                case 'semana':
                    $query->whereBetween('fecha', [
                        now()->startOfWeek()->toDateString(),
                        now()->endOfWeek()->toDateString()
                    ]);
                    break;
                case 'mes':
                    $query->whereBetween('fecha', [
                        now()->startOfMonth()->toDateString(),
                        now()->endOfMonth()->toDateString()
                    ]);
                    break;
            }
        }

        // Filtro por tipo
        if ($request->has('tipo') && $request->input('tipo') != '') {
            $query->where('tipo', $request->input('tipo'));
        }

        // Obtener resultados paginados - 5 por página
        $pedidos = $query->paginate(5);

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
        $pedidos = Pedido::with('cliente')->get();
        return view('pedidos', compact('pedidos'));
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
