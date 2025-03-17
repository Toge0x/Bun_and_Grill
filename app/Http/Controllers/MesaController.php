<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::orderBy('numero','asc')->paginate(10);
        return view('mesas.index', compact('mesas'));
    }

    public function create()
    {
        return view('mesas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero'    => 'required|integer|unique:mesas,numero',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'required|string'
        ]);

        Mesa::create($request->all());

        return redirect()->route('mesas.index')
                         ->with('success', 'Mesa creada correctamente.');
    }

    public function show($id)
    {
        $mesa = Mesa::findOrFail($id);
        return view('mesas.show', compact('mesa'));
    }

    public function edit($id)
    {
        $mesa = Mesa::findOrFail($id);
        return view('mesas.edit', compact('mesa'));
    }

    public function update(Request $request, $id)
    {
        $mesa = Mesa::findOrFail($id);

        $request->validate([
            'numero'    => 'required|integer|unique:mesas,numero,'.$id,
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'required|string'
        ]);

        $mesa->update($request->all());

        return redirect()->route('mesas.index')
                         ->with('success', 'Mesa actualizada correctamente.');
    }

    public function destroy($id)
    {
        $mesa = Mesa::findOrFail($id);
        $mesa->delete();

        return redirect()->route('mesas.index')
                         ->with('success', 'Mesa eliminada correctamente.');
    }
}
