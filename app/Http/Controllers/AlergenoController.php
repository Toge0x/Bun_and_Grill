<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use Illuminate\Http\Request;

class AlergenoController extends Controller
{
    public function index()
    {
        $alergenos = Alergeno::orderBy('id', 'desc')->paginate(10);
        return view('alergenos.index', compact('alergenos'));
    }

    public function create()
    {
        return view('alergenos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
        ]);

        Alergeno::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('alergenos.index')
                         ->with('success', 'Alérgeno creado correctamente.');
    }

    public function show($id)
    {
        $alergeno = Alergeno::findOrFail($id);
        return view('alergenos.show', compact('alergeno'));
    }

    public function edit($id)
    {
        $alergeno = Alergeno::findOrFail($id);
        return view('alergenos.edit', compact('alergeno'));
    }

    public function update(Request $request, $id)
    {
        $alergeno = Alergeno::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:255',
        ]);

        $alergeno->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('alergenos.index')
                         ->with('success', 'Alérgeno actualizado correctamente.');
    }

    public function destroy($id)
    {
        $alergeno = Alergeno::findOrFail($id);
        $alergeno->delete();

        return redirect()->route('alergenos.index')
                         ->with('success', 'Alérgeno eliminado correctamente.');
    }
}
