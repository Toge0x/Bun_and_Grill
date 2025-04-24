<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    protected $table = 'carta';

    protected $fillable = [
        'nombre',
        'fecha',
        'idRestaurante'
    ];

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'idRestaurante');
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'idCarta');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'carta_producto', 'idCarta', 'idProducto');
    }
}
