<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoracion';

    protected $fillable = [
        'comentario',
        'valor',
        'fecha',
        'emailCliente',
        'idRestaurante'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'emailCliente', 'email');
    }

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'idRestaurante');
    }
}
