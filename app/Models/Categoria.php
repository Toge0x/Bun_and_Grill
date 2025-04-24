<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $fillable = [
        'nombre',
        'idCarta'
    ];

    public function carta()
    {
        return $this->belongsTo(Carta::class, 'idCarta');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idCategoria');
    }
}
