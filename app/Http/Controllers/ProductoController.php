<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $productos = Producto::create([        // validado en RegisterRequest ya podemos crearlo directamente
            'nombre'     => $request->nombre,
            'ingredientes'  => $request->ingredientes,
            'alergenos'      => $request->alergenos,
            'precio'   =>  $request->precio,
            'valoraciones'   => $request->valoraciones,
            'imagen'  => $request->imagen,
        ]);


        return redirect()->route('hamburguesas.index')
        ->with('success','Hamburguesa creada correctamente.');
    }

    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('hamburguesas', compact('producto'));
    }
    public function showAll(string $id)
    {
        $productos = Producto::all();
        return view('hamburguesas', compact('productos'))
    }
    
    public function edit(string $id)
    {
        $productos = Producto::findOrFail($id);
        return view('hamburguesas.edit', compact('productos'));
    }

    public function update(Request $request, string $id)
    {

    $productos = Producto::findOrFail($id);
    $productos->update($request->all());

    return redirect()->route('hamburguesas.index')
                         ->with('success','Hamburguesa actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $reserva = Producto::findOrFail($id);
        $reserva->delete();
        return redirect()->route('hamburguesas.index')
                         ->with('success','Hamburguesa eliminada correctamente.');
    }
}
