<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    protected $table = 'restaurante';

    protected $fillable = [
        'cif',
        'telfs',
        'descripcion',
        'email',
        'idUbicacion'
    ];

    protected $casts = [
        'telfs' => 'array',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'idUbicacion');
    }

    public function administradores()
    {
        return $this->hasMany(Administrador::class, 'idRestaurante');
    }

    public function cartas()
    {
        return $this->hasMany(Carta::class, 'idRestaurante');
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'idRestaurante');
    }

    public function mesas()
    {
        return $this->hasMany(Mesa::class, 'idRestaurante');
    }
}
