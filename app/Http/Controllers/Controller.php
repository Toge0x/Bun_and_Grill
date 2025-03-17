<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required',
            'email'    => 'required|email|unique:clientes,email',
            'password' => 'required'
        ]);

        Cliente::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente creado correctamente.');
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'email'  => 'required|email|unique:clientes,email,'.$id,
        ]);

        $cliente->nombre = $request->nombre;
        $cliente->email  = $request->email;
        if ($request->filled('password')) {
            $cliente->password = Hash::make($request->password);
        }

        $cliente->save();

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente eliminado correctamente.');
    }
}
