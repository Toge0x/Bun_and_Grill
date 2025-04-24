<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administrador';

    protected $fillable = [
        'emailUsuario',
        'idRestaurante'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'emailUsuario', 'email');
    }

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'idRestaurante');
    }
}