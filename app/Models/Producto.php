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

    public function lineasPedido()
    {
        return $this->hasMany(LineaPedido::class, 'producto_id', 'idProducto');
    }
}
