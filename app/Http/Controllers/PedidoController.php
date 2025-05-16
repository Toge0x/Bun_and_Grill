<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\LineaPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::query(); // Ajusta esto al nombre de tu modelo si es diferente

        // Búsqueda
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('cliente_email', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
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
                    $query->whereDate('fecha', now()->toDateString());
                    break;
                case 'ayer':
                    $query->whereDate('fecha', now()->subDay()->toDateString());
                    break;
                case 'semana':
                    $query->whereBetween('fecha', [
                        now()->startOfWeek()->toDateString(),
                        now()->endOfWeek()->toDateString()
                    ]);
                    break;
                case 'mes':
                    $query->whereBetween('fecha', [
                        now()->startOfMonth()->toDateString(),
                        now()->endOfMonth()->toDateString()
                    ]);
                    break;
            }
        }

        // Filtro por tipo
        if ($request->has('tipo') && $request->input('tipo') != '') {
            $query->where('tipo', $request->input('tipo'));
        }

        // Obtener resultados paginados - 5 por página
        $pedidos = $query->paginate(5);

        return view('pedidos', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los productos
        $productos = Producto::all();

        // Agrupar productos por categoría (en este caso usamos un array simple)
        $categorias = ['Hamburguesas', 'Entrantes', 'Bebidas', 'Postres'];

        // Asignar productos a categorías (simulado)
        $productosPorCategoria = [];
        foreach ($categorias as $categoria) {
            $productosPorCategoria[$categoria] = $productos->filter(function ($producto) use ($categoria) {
                // Aquí deberías tener una lógica real para filtrar por categoría
                // Por ahora asignamos aleatoriamente
                return true;
            });
        }

        return view('form-pedidos', [
            'categorias' => $categorias,
            'productos' => $productosPorCategoria
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'pedido.cliente_email' => 'required|email',
            'pedido.fecha' => 'required|date',
            'pedido.estado' => 'required|string',
            'pedido.total' => 'required|numeric',
            'cliente.email' => 'required|email',
            'cliente.nombre' => 'required|string',
            'cliente.telefono' => 'required|string',
            'lineas' => 'required|array',
            'lineas.*.producto_id' => 'required|exists:productos,idProducto',
            'lineas.*.cantidad' => 'required|integer|min:1',
            'lineas.*.subtotal' => 'required|numeric'
        ]);

        // Iniciar transacción
        DB::beginTransaction();

        try {
            // Verificar si existe un usuario con ese email
            $usuario = \App\Models\Usuario::where('email', $request->input('cliente.email'))->first();

            // Si no existe el usuario, crearlo primero
            if (!$usuario) {
                $usuario = new \App\Models\Usuario();
                $usuario->email = $request->input('cliente.email');
                $usuario->nombre = $request->input('cliente.nombre');
                $usuario->apellidos = ''; // Añadir un valor por defecto o tomar del formulario
                $usuario->password = bcrypt('password_temporal'); // Asignar una contraseña temporal
                $usuario->telefono = $request->input('cliente.telefono');
                $usuario->direccion = $request->input('cliente.direccion');
                $usuario->sexo = 'Otro'; // Valor por defecto o tomar del formulario
                $usuario->save();
            }

            // Ahora podemos crear o actualizar el cliente
            $cliente = Cliente::firstOrCreate(
                ['email' => $request->input('cliente.email')],
                [
                    'puntos' => 0 // Asumiendo que los clientes nuevos comienzan con 0 puntos
                ]
            );

            // Crear el pedido
            $pedido = new Pedido();
            $pedido->cliente_email = $request->input('pedido.cliente_email');
            $pedido->fecha = $request->input('pedido.fecha');
            $pedido->estado = $request->input('pedido.estado');
            $pedido->total = $request->input('pedido.total');
            $pedido->save();

            // Crear las líneas de pedido
            foreach ($request->input('lineas') as $linea) {
                $lineaPedido = new LineaPedido();
                $lineaPedido->pedido_id = $pedido->id;
                $lineaPedido->producto_id = $linea['producto_id'];
                $lineaPedido->cantidad = $linea['cantidad'];
                $lineaPedido->subtotal = $linea['subtotal'];
                $lineaPedido->save();
            }

            // Confirmar transacción
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pedido creado correctamente',
                'pedido_id' => $pedido->id
            ]);
        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al crear el pedido: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pedido = Pedido::with(['cliente', 'lineas.producto'])->findOrFail($id);
        return view('pedido-detalle', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pedido = Pedido::with(['cliente', 'lineas.producto'])->findOrFail($id);
        return view('pedido-edit', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'estado' => 'required|string|in:pendiente,en_preparacion,en_reparto,entregado,cancelado'
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Estado del pedido actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }
}
