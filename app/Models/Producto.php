<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'idProducto';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'ingredientes',
        'precio',
        'imagen',
    ];

    protected $casts = [
        'ingredientes' => 'array',
    ];

    // relaciones

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'producto_id', 'idProducto');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria');
    }


    public function lineasPedido()
    {
        return $this->hasMany(LineaPedido::class, 'producto_id', 'idProducto');
    }

    public static function borrarProducto($id)
    {
        $productos = self::find($id);
        if ($productos) {
            $productos->delete();
            return ['message' => 'Producto borrada'];
        }
        return ['message' => 'Producto no encontrado'];
    }

    public static function actualizarProducto($id, $datos)
    {
        $productos = self::find($id);
        if ($productos) {
            $productos->update($datos);
            return $productos;
        }
        return ['message' => 'Producto no actualizada'];
    }

    public function leerTodosProducto()
    {
        $productos = self::all();
        if ($productos) {
            return  $productos;
        }
        return ['message' => 'Producto no leida'];
    }

    public function crearProducto($datos)
    {
        $productos = self::create($datos);
        if ($productos) {
            return  $productos;
        }
        return ['message' => 'Producto no creada'];
    }
}
