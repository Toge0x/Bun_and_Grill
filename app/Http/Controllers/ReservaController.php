<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Mesa;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form-reservas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fechaReserva' => 'required|date',
            'horaReserva' => 'required|date_format:H:i',
            'personas' => 'required|integer|min:1|max:20',
            'zona' => 'required|string|in:Interior,Exterior',
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'comentarios' => 'nullable|string'
        ]);

        // Iniciar transacción
        DB::beginTransaction();

        try {
            // Verificar si existe un usuario con ese email
            $usuario = \App\Models\Usuario::where('email', $request->email)->first();

            // Si no existe el usuario, crearlo primero
            if (!$usuario) {
                $usuario = new \App\Models\Usuario();
                $usuario->email = $request->email;
                $usuario->nombre = $request->nombre;
                $usuario->password = bcrypt('password_temporal'); // Asignar una contraseña temporal
                $usuario->save();
            }

            // Ahora podemos crear o actualizar el cliente
            $cliente = Cliente::firstOrCreate(
                ['email' => $request->email],
                [
                    'nombre' => $request->nombre,
                    'telefono' => $request->telefono
                ]
            );

            // Buscar mesas disponibles
            $mesasDisponibles = $this->buscarMesasDisponibles(
                $request->fechaReserva,
                $request->horaReserva,
                $request->zona,
                $request->personas
            );

            if ($mesasDisponibles->isEmpty()) {
                return redirect()->back()->withInput()->withErrors(['No hay mesas disponibles para la fecha, hora y zona seleccionadas. Por favor, seleccione otra opción.']);
            }

            // Seleccionar la mesa más adecuada (la de menor capacidad que cumpla con los requisitos)
            $mesa = $mesasDisponibles->sortBy('capacidad')->first();

            // Crear la reserva - Asegurarse de que el estado esté entre comillas
            $reserva = new Reserva();
            $reserva->cliente_email = $cliente->email;
            $reserva->mesa_id = $mesa->mesa_id;
            $reserva->fechaReserva = $request->fechaReserva;
            $reserva->horaReserva = $request->horaReserva;
            $reserva->duracion = 2; // 2 horas por defecto
            $reserva->estado = 'Reservada'; // Cambiado a minúsculas para evitar problemas con ENUM
            $reserva->save();

            // Confirmar transacción
            DB::commit();

            return redirect()->back()->with('success', 'Reserva realizada correctamente. Te enviaremos un email de confirmación.');
        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            DB::rollBack();

            return redirect()->back()->withInput()->withErrors(['Error al procesar la reserva: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reserva = Reserva::with(['cliente', 'mesa'])->findOrFail($id);
        return view('reserva-detalle', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reserva = Reserva::with(['cliente', 'mesa'])->findOrFail($id);
        return view('reserva-edit', compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'estado' => 'required|string|in:pendiente,confirmada,cancelada,completada'
        ]);

        $reserva = Reserva::findOrFail($id);
        $reserva->estado = $request->estado;
        $reserva->save();

        return redirect()->route('reservas.index')->with('success', 'Estado de la reserva actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente');
    }

    /**
     * Buscar mesas disponibles para la fecha, hora y zona especificadas.
     */
    private function buscarMesasDisponibles($fecha, $hora, $zona, $personas)
    {
        // Obtener todas las mesas de la zona especificada con capacidad suficiente
        $mesas = Mesa::where('estado', 'Disponible')
            ->where('capacidad', '>=', $personas)
            ->get();

        if ($mesas->isEmpty()) {
            return collect();
        }

        // Calcular el rango horario de la reserva (2 horas por defecto)
        $horaInicio = date('H:i', strtotime($hora));
        $horaFin = date('H:i', strtotime($hora . ' +2 hours'));

        // Obtener las reservas existentes para la fecha especificada
        $reservasExistentes = Reserva::where('fechaReserva', $fecha)
            ->where('estado', '!=', 'cancelada')
            ->get();

        // Filtrar las mesas que ya están reservadas en ese horario
        $mesasDisponibles = $mesas->filter(function ($mesa) use ($reservasExistentes, $horaInicio, $horaFin) {
            foreach ($reservasExistentes as $reserva) {
                $reservaInicio = date('H:i', strtotime($reserva->horaReserva));
                $reservaFin = date('H:i', strtotime($reserva->horaReserva . ' +' . $reserva->duracion . ' hours'));

                // Verificar si hay solapamiento de horarios
                if (
                    $mesa->mesa_id == $reserva->mesa_id &&
                    (($horaInicio >= $reservaInicio && $horaInicio < $reservaFin) ||
                        ($horaFin > $reservaInicio && $horaFin <= $reservaFin) ||
                        ($horaInicio <= $reservaInicio && $horaFin >= $reservaFin))
                ) {
                    return false;
                }
            }
            return true;
        });

        return $mesasDisponibles;
    }
}
