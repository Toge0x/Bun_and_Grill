<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_email',
        'fecha',
        'estado',
        'total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_email', 'email');
    }

    public function lineas()
    {
        return $this->hasMany(LineaPedido::class, 'pedido_id');
    }

    public static function borrarPedido($id) 
    {
        $pedidos = self::find($id); 
        if ($pedidos) {
            $pedidos->delete();
            return ['message' => 'Pedido borrada'];
        }
        return ['message' => 'Pedido no encontrado'];
    }

    public static function actualizarPedido($id, $datos)
    {
    $pedidos = self::find($id);
    if ($pedidos) {
        $pedidos->update($datos);
        return $pedidos;
    }
    return ['message' => 'Pedido no actualizada'];
    }

    public function leerTodosPedidos(){
        $pedidos = self::all();
        if($pedidos){
            return  $pedidos;
        }
        return ['message' => 'Pedido no leida'];
    }

    public function crearPedido($datos)
    {
        $pedidos = self::create($datos);
        if($pedidos){
            return  $pedidos;
        }
        return ['message' => 'Pedido no creada'];
    }
}
