<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicacion';

    protected $fillable = [
        'direccion',
        'codPostal'
    ];

    public function restaurantes()
    {
        return $this->hasMany(Restaurante::class, 'idUbicacion');
    }
}
