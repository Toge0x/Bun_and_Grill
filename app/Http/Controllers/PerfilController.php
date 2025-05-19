<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function index()
    {
        // Obtener el usuario actual desde la sesión
        $email = session('logged_user.email');
        $usuario = Usuario::where('email', $email)->first();

        return view('perfil', compact('usuario'));
    }

    public function update(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuarios,email,' . $request->email . ',email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'sexo' => 'nullable|in:M,F,O',
        ]);

        // Obtener el usuario actual
        $email = session('logged_user.email');
        $usuario = Usuario::where('email', $email)->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        // Actualizar los datos del usuario
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;
        $usuario->sexo = $request->sexo;

        // Si el email ha cambiado, actualizarlo
        if ($email !== $request->email) {
            // Actualizar también en la tabla clientes si existe
            $cliente = \App\Models\Cliente::where('email', $email)->first();
            if ($cliente) {
                $cliente->email = $request->email;
                $cliente->save();
            }

            $usuario->email = $request->email;

            // Actualizar la sesión con el nuevo email
            session([
                'logged_user' => [
                    'email' => $request->email,
                    'nombre' => $request->nombre,
                    'apellidos' => $request->apellidos,
                ]
            ]);
        } else {
            // Actualizar solo nombre y apellidos en la sesión
            session([
                'logged_user' => [
                    'email' => $email,
                    'nombre' => $request->nombre,
                    'apellidos' => $request->apellidos,
                ]
            ]);
        }

        $usuario->save();

        return redirect()->route('perfil.index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function updatePassword(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Obtener el usuario actual
        $email = session('logged_user.email');
        $usuario = Usuario::where('email', $email)->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, $usuario->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        // Actualizar la contraseña
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return redirect()->route('perfil.index')->with('success', 'Contraseña actualizada correctamente.');
    }
}
