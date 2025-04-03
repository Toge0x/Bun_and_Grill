<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Mesa;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $query = Reserva::query(); // Ajusta esto al nombre de tu modelo si es diferente

        // Búsqueda
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('cliente_email', 'like', "%{$search}%");
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
                    $query->whereDate('fechaReserva', now()->toDateString());
                    break;
                case 'manana':
                    $query->whereDate('fechaReserva', now()->addDay()->toDateString());
                    break;
                case 'semana':
                    $query->whereBetween('fechaReserva', [
                        now()->startOfWeek()->toDateString(),
                        now()->endOfWeek()->toDateString()
                    ]);
                    break;
                case 'mes':
                    $query->whereBetween('fechaReserva', [
                        now()->startOfMonth()->toDateString(),
                        now()->endOfMonth()->toDateString()
                    ]);
                    break;
            }
        }

        // Filtro por número de personas
        if ($request->has('personas') && $request->input('personas') != '') {
            $personas = $request->input('personas');

            switch ($personas) {
                case '1-2':
                    $query->whereBetween('personas', [1, 2]);
                    break;
                case '3-4':
                    $query->whereBetween('personas', [3, 4]);
                    break;
                case '5-6':
                    $query->whereBetween('personas', [5, 6]);
                    break;
                case '7+':
                    $query->where('personas', '>=', 7);
                    break;
            }
        }

        // Obtener resultados paginados - 5 por página
        $reservas = $query->paginate(5);

        return view('listado-reservas', compact('reservas'));
    }


    public function create()
    {
        $clientes = Cliente::orderBy('nombre', 'asc')->get();
        $mesas    = Mesa::orderBy('numero', 'asc')->get();
        return view('reservas.create', compact('clientes', 'mesas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha'        => 'required|date',
            'hora'         => 'required',
            'num_personas' => 'required|integer|min:1',
            'estado'       => 'required|in:pendiente,confirmada,cancelada',
            'cliente_id'   => 'required|exists:clientes,id',
            'mesa_id'      => 'required|exists:mesas,id'
        ]);

        Reserva::create($request->all());

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva creada correctamente.');
    }

    public function show($id)
    {
        $reservas = Reserva::with(['cliente', 'mesa'])
            ->where('id', $id)
            ->get();
        return view('reservas', compact('reservas'));
    }

    public function showAll()
    {
        $reservas = Reserva::with(['cliente', 'mesa'])->get();
        return view('listado-reservas', compact('reservas'));
    }

    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        $clientes = Cliente::orderBy('nombre', 'asc')->get();
        $mesas    = Mesa::orderBy('numero', 'asc')->get();
        return view('reservas.edit', compact('reserva', 'clientes', 'mesas'));
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);

        $request->validate([
            'fecha'        => 'required|date',
            'hora'         => 'required',
            'num_personas' => 'required|integer|min:1',
            'estado'       => 'required|in:pendiente,confirmada,cancelada',
            'cliente_id'   => 'required|exists:clientes,id',
            'mesa_id'      => 'required|exists:mesas,id'
        ]);

        $reserva->update($request->all());

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva actualizada correctamente.');
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva eliminada correctamente.');
    }
}
