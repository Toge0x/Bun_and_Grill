<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cliente;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UsuarioController extends Controller
{

    public function index(Request $request)
    {
        $query = Usuario::query(); // Ajusta esto al nombre de tu modelo si es diferente

        // Añadir funcionalidad de búsqueda
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%");
            });
        }

        // Obtener resultados paginados - 5 por página
        $usuarios = $query->paginate(5);

        return view('clientes', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(RegisterRequest $request)
    {
        $usuario = Usuario::create([        // validado en RegisterRequest ya podemos crearlo directamente
            'nombre'     => $request->nombre,
            'apellidos'  => $request->apellidos,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'telefono'   => $request->telefono,
            'direccion'  => $request->direccion,
            'sexo'       => $request->sexo,
        ]);

        Cliente::create([
            'email'   => $usuario->email,
            'puntos'  => 0,
        ]);

        return redirect()->route('home')->with('success', '¡Registro completado correctamente!');
    }


    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('clientes', compact('usuario'));
    }

    public function showAll()
    {
        $usuarios = Usuario::all();
        return view('clientes', compact('usuarios'));
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
            'email'  => 'required|email|unique:usuarios,email,' . $id,
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->email  = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    public function checkLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Credenciales incorrectas.'])
                ->withInput(); // mantiene el email escrito
        }

        // Si llegas aquí, las credenciales son buenas:
        $request->session()->regenerate();

        // Redirige al usuario donde quiera ir (o al form-reservas)
        return redirect()->intended(route('form-reservas'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }


}
