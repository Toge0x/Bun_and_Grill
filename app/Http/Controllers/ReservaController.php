<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Mesa;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['cliente','mesa'])
                           ->orderBy('fecha','desc')
                           ->paginate(10);

        return view('reservas', compact('reservas'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre','asc')->get();
        $mesas    = Mesa::orderBy('numero','asc')->get();
        return view('reservas.create', compact('clientes','mesas'));
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
                         ->with('success','Reserva creada correctamente.');
    }

    public function show($id)
    {
        $reserva = Reserva::with(['cliente','mesa'])->findOrFail($id);
        return view('reservas', compact('reserva'));
    }

    public function showAll()
    {
        $reserva = Reserva::with(['cliente','mesa'])->all();
        return view('reservas', compact('reserva'));
    }
    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        $clientes = Cliente::orderBy('nombre','asc')->get();
        $mesas    = Mesa::orderBy('numero','asc')->get();
        return view('reservas.edit', compact('reserva','clientes','mesas'));
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
                         ->with('success','Reserva actualizada correctamente.');
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('reservas.index')
                         ->with('success','Reserva eliminada correctamente.');
    }
}
