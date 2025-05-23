<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CartaController extends Controller
{
    /**
     * Muestra la página de la carta con todos los productos.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('carta', compact('productos'));
    }

    /**
     * Muestra la página de la hamburguesa del mes.
     * Selecciona aleatoriamente una hamburguesa de la categoría 1 (Hamburguesas).
     */
    public function hamburguesaDelMes()
    {
        // Obtener todas las hamburguesas (categoría 1)
        $hamburguesas = Producto::where('idCategoria', 1)->get();

        // Si no hay hamburguesas, redirigir a la carta
        if ($hamburguesas->isEmpty()) {
            return redirect()->route('carta')->with('error', 'No hay hamburguesas disponibles');
        }

        // Seleccionar una hamburguesa aleatoria
        $hamburguesa = $hamburguesas->random();

        return view('hamburguesa-mes', compact('hamburguesa'));
    }
}
