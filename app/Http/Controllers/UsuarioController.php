<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function checkLogin(Request $request)
    {   // Corregir después
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $usuario = Usuario::where('email', $request->email)->first();


    }

    public function index()
    {
        $usuarios = Usuario::orderBy('id','desc')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required',
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required'
        ]);

        Usuario::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('usuarios.index')
                         ->with('success','Usuario creado correctamente.');
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'email'  => 'required|email|unique:usuarios,email,'.$id,
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->email  = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')
                         ->with('success','Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
                         ->with('success','Usuario eliminado correctamente.');
    }
}
