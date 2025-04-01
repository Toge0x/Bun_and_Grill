<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    use HasFactory;

    protected $table = 'lineas_pedido';
    protected $primaryKey = 'idLineaPedido';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'subtotal',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'idProducto');
    }

       public static function borrarLinped($id) 
    {
        $linped = self::find($id); 
        if ($linped) {
            $linped->delete();
            return ['message' => 'Linped borrada'];
        }
        return ['message' => 'Linped no encontrado'];
    }

    public static function actualizarLinped($id, $datos)
    {
    $linped = self::find($id);
    if ($linped) {
        $linped->update($datos);
        return $linped;
    }
    return ['message' => 'Linped no actualizada'];
    }

    public function leerTodosLinped(){
        $linped = self::all();
        if($linped){
            return  $linped;
        }
        return ['message' => 'Linped no leida'];
    }

    public function crearLinped($datos)
    {
        $linped = self::create($datos);
        if($linped){
            return  $linped;
        }
        return ['message' => 'Linped no creada'];
    }
}
