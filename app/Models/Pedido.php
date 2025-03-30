<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_email',
        'fecha',
        'estado',
        'total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_email', 'email');
    }

    public function lineas()
    {
        return $this->hasMany(LineaPedido::class, 'pedido_id');
    }
}
