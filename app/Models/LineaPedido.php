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
}
